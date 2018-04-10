# 説明

Laravelアプリケーションの設定のバリデーションを行います。

# インストール

```console
composer require crhg/laravel-config-validator
```

# 使い方

## ルールを用意する

サービスプロバイダクラスに`Crhg\ConfigValidator\Interfaces\ConfigValidationRuleProvider`インタフェースを
実装します。

`getConfigValidationRule()`というバリデーションルールの配列を返す無引数の関数を定義します。
ルールの書き方はLaravelの[リクエストに使うバリデータ](https://laravel.com/docs/master/validation)([日本語](https://readouble.com/laravel/master/ja/validation.html))と同じです。

### 例

```php
class AppServiceProvider extends Provider implements ConfigValidationRuleProvider
{
    public function getConfigValidationRule()
    {
        return [
            'app.foo' => 'required',
        ];
    }
}

```

## チェックを行う

`config:validate`コマンドを実行することで用意したルールを使って現在の設定のバリデーションを行います。

```console
% php artisan config:varidate
app.foo: The app.foo field is required.
```

問題があればメッセージが表示されます。

問題があるときはコマンドの終了ステータスが1になります。

# BUGS

* 本来requestのパラメータチェックに使用するValidatorを使っているので時々表現が奇妙なことがあります。