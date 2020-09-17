<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Localization\LocalizationKey;
use App\Models\Localization\LocalizationValue;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class LocalizationController extends Controller
{
    private $search;

    private $locale;

    /**
     * Return a listing of the localization keys and values.
     *
     * Возвращаем список элементов локалицаций с переводами для каждой локали.
     * Доступно использование параметров offset, limit, search, без этих параметров возвращает полный список
     * При использовании параметра search возвращает все локализации для ключа если хоть в одной есть искомое значение
     *
     * ===========================================
     * Пример запроса:
     * Метод GET
     * <url>/localization?offset=200&limit=100&search=tit
     * ===========================================
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $localizations = LocalizationKey::with('values');

        if ($request->get('search')) {
            $this->search = $request->get('search');
            $localizations->whereHas('values', function ($q) {
                $q->where('value', 'LIKE', '%' . $this->search . '%');
            });
        }

        if ($request->get('offset')) {
            $localizations->skip($request->get('offset'));
        }

        if ($request->get('limit')) {
            $localizations->take($request->get('limit'));
        }

        $localizations = $localizations->get();

        $result = array(
            'count' => $localizations->count(),
            'data' => $localizations,
        );

        return response()->json($result);
    }

    /**
     * Get localization key value.
     *
     * Получение локализованного значения для одного ключа
     *
     * ===========================================
     * Пример запроса:
     * Метод GET
     * <url>/localization/ru/common.open
     *
     * Пример ответа:
     *  {
     *  "status": "success",
     *      "data": {
     *      "key": "common.open",
     *      "locale": "ru",
     *      "value": "Открыть"
     *      }
     *  }
     * ===========================================
     *
     * @param Request $request
     * @param string $locale
     * @param LocalizationKey $key
     *
     * @return Response
     */
    public function value(Request $request, $locale, $key)
    {

        $key = LocalizationKey::where('key', $key)->first();

        if (!empty($key)) {
            $localizationValue = LocalizationValue::where('localization_key_id', $key->id)
                ->where('locale', $locale)
                ->first();
        }

        if ($key && $localizationValue) {
            $status_code = 200;
            $result = array(
                'status' => 'success',
                'data' => array(
                    'key' => $localizationValue->key->key,
                    'locale' => $localizationValue->locale,
                    'value' => $localizationValue->value
                )
            );
        } else {
            $status_code = 404;
            $result = array(
                'status' => 'error',
                'data' => array(
                    'message' => 'Not found'
                )
            );
        }

        return response()->json($result, $status_code);
    }

    /**
     * Get localization values by array of keys.
     *
     * Получение локализованных значений для массива ключей.
     *
     * ===========================================
     * Пример запроса:
     * Метод POST
     * <url>/localization/keys
     *
     * Тело запроса
     * {
     * "locale":"ru",
     * "keys":[
     *      "common.title",
     *      "common.description",
     *      "common.open",
     *      "common.close",
     *      "common.cancel"
     *      ]
     * }
     *
     * Пример ответа:
     *  {
     *  "status": "success",
     *  "count": 5,
     *  "data": {
     *      "common.cancel": "Отменить",
     *      "common.close": "Закрыть",
     *      "common.description": "Описание",
     *      "common.open": "Открыть",
     *      "common.title": "Заголовок"
     *      }
     *  }
     * ===========================================
     *
     * @param Request $request
     * @return Response
     */
    public function keys(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'locale' => 'required|in:' . implode(',', config('app.locales')),
            'keys' => 'required'
        ]);

        if ($validator->fails()) {
            $status_code = 400;

            $result = array(
                'status' => 'error',
                'data' => array(
                    'message' => $validator->messages()->first()
                ),
            );

            return response()->json($result, $status_code);
        }

        $keys = LocalizationKey::whereIn('key', $request->input('keys'))->get();
        $data = collect([]);
        foreach ($keys as $key) {
            $localizationValue = LocalizationValue::where('localization_key_id', $key->id)
                ->where('locale', $request->input('locale'))
                ->first();
            $data[$key->key] = $localizationValue->value;
        }

        $status_code = 200;
        $result = array(
            'status' => 'success',
            'count' => $data->count(),
            'data' => $data
        );

        return response()->json($result, $status_code);
    }


    /**
     * Store a newly created resource in storage.
     *
     * Создание и сохранение нового ключа с локализациями.
     *
     * ===========================================
     * Пример запроса для создания ключа "common.country":
     * Метод POST
     * <url>/localization/
     *
     * Тело запроса
     *  {
     *  "key":"common.country",
     *      "locales":{
     *      "en":"Country",
     *      "ru":"Страна",
     *      "ua":"Країна"
     *      }
     *  }
     *
     * Пример ответа:
     *   {
     *   "status": "success",
     *   "id": 27,
     *   "key": "common.country",
     *   "data": [
     *       {
     *           "id": 68,
     *           "localization_key_id": 27,
     *           "locale": "en",
     *           "value": "Country"
     *       },
     *       {
     *           "id": 69,
     *           "localization_key_id": 27,
     *           "locale": "ru",
     *           "value": "Страна"
     *       },
     *       {
     *           "id": 70,
     *           "localization_key_id": 27,
     *           "locale": "ua",
     *           "value": "Країна"
     *       }
     *     ]
     *   }
     * ===========================================
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'key' => 'required|unique:localization_keys,key',
        ]);

        if ($validator->fails()) {
            $status_code = 400;

            $result = array(
                'status' => 'error',
                'data' => array(
                    'message' => $validator->messages()->first()
                ),
            );

            return response()->json($result, $status_code);
        }

        $status_code = 200;
        $key = LocalizationKey::create([
            'key' => $request->get('key')
        ]);

        foreach ($request->get('locales') as $locale => $value) {
            if (in_array($locale, config('app.locales'))) {
                LocalizationValue::create([
                    'localization_key_id' => $key->id,
                    'locale' => $locale,
                    'value' => $value
                ]);
            }
        }

        $result = array(
            'status' => 'success',
            'id' => $key->id,
            'key' => $key->key,
            'data' => $key->values,
        );

        return response()->json($result, $status_code);

    }


    /**
     * Update the specified resource in storage.
     *
     * Изменение существующего ключа.
     * Редактирование локализованных значений ключа.
     *
     * Для изменения ключа в теле запроса требуется обязательный параметр "key" с именем нового ключа
     * Для обычного редактирования значений изменение ключа не требуется и нужны лишь значения локализаций
     *
     * ===========================================
     * Пример запроса для редактирования значений ключа "common.post.office":
     * Метод PUT
     * <url>/localization/common.post.office
     *
     * Тело запроса:
     *  {
     *  "locales": {
     *      "en": "Post office",
     *      "ru": "Почтовое отделение",
     *      "ua": "Поштове відділення"
     *      }
     *  }
     * ===========================================
     * Пример запроса для изменения ключа "common.post.office"
     *
     * Метод PUT
     * <url>/localization/common.post.office
     *
     * Тело запроса:
     *  {
     *  "key": "common.comment"
     *  "locales": {
     *      "en": "Comment",
     *      "ru": "Комментарий",
     *      "ua": "Коментар"
     *      }
     *  }
     *
     * Внимание! При выполнении такого запроса ранее существовавший ключ (common.post.office) перестает существовать и прежний url вернет 404.
     * Вместо него создается новый (common.comment) с новыми значаниями локализаций.
     * id ключа и значений остаются прежними т.к. выполняется редактирование существующих данных.
     * ===========================================
     *
     * @param Request $request
     * @param LocalizationKey $key
     * @return Response
     */
    public function update(Request $request, $key)
    {
        $validator = Validator::make($request->all(), [
            'key' => 'unique:localization_keys,key',
        ]);

        if ($validator->fails()) {
            $status_code = 400;

            $result = array(
                'status' => 'error',
                'data' => array(
                    'message' => $validator->messages()->first()
                ),
            );

            return response()->json($result, $status_code);
        }

        $key = LocalizationKey::where('key', $key)->first();

        if (!$key) {
            $status_code = 404;

            $result = array(
                'status' => 'error',
                'data' => array(
                    'message' => 'Not found'
                ),
            );

            return response()->json($result, $status_code);
        }

        if ($request->get('key')) {
            $key->update([
                'key' => $request->get('key')
            ]);
        }

        if (!empty($key)) {
            $status_code = 200;
            if ($request->get('locales')) {
                foreach ($request->get('locales') as $locale => $value) {
                    if (in_array($locale, config('app.locales'))) {
                        $localizationValue = LocalizationValue::where('localization_key_id', $key->id)
                            ->where('locale', $locale)
                            ->first();
                        if ($localizationValue) {
                            $localizationValue->update([
                                'value' => $value,
                            ]);
                        } else {
                            LocalizationValue::create([
                                'localization_key_id' => $key->id,
                                'locale' => $locale,
                                'value' => $value
                            ]);
                        }

                    }
                }
            }

            $result = array(
                'status' => 'success',
                'id' => $key->id,
                'key' => $key->key,
                'data' => $key->values,
            );
        } else {
            $status_code = 404;
            $result = array(
                'status' => 'error',
                'data' => array(
                    'message' => 'Not found'
                )
            );
        }

        return response()->json($result, $status_code);
    }

    /**
     * Remove the specified resource from storage.
     *
     * Удаление ключа и значений
     *
     * ===========================================
     * Пример запроса для удаления ключа "common.post"
     *
     * Метод DELETE
     * <url>/localization/common.post
     *
     * ===========================================
     *
     * @param LocalizationKey $key
     * @return Response
     */
    public function destroy($key)
    {
        $key = LocalizationKey::where('key', $key)->first();

        if (!$key) {
            $status_code = 404;

            $result = array(
                'status' => 'error',
                'data' => array(
                    'message' => 'Not found'
                ),
            );
        } else {
            $status_code = 200;
            $key->delete();

            $result = array(
                'status' => 'success',
                'data' => array(
                    'message' => 'Key deleted'
                ),
            );
        }

        return response()->json($result, $status_code);
    }

}
