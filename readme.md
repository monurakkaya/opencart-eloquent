# OPENCART-ELOQUENT

Yet another OpenCart database package for lazy laravel developers.
I wrote this package to use with my OpenCart extensions. It does not replace whole opencart models with eloquent models. It just gives you the opportunity to use eloquent ORM flexibility while querying

### INSTALLATION
1. First, install the package via composer:
    ```shell
    composer require monurakkaya/opencart-eloquent
    ```
2. Then copy ocmod file to your system directory
    ```shell
    cp storage/vendor/monurakkaya/opencart-eloquent/src/*.xml upload/system
    ```
3. Go to your admin panel and refresh modifications.


### EXAMPLES
To get categories count which have products in it, just type:
```php
use App\Models\Catalog\Category\Category;

$categories_count = Category::whereHas('products')
    ->with('description')
    ->count();
```

To get categories with products count, just type:
```php
use App\Models\Catalog\Category\Category;

$categories = Category::with('description')
    ->withCount('products')->get();

echo $categories->first()->products_count // 5
echo $categories->first()->description->name // Electronics
```

Options and values 

```php
use App\Models\Catalog\Option\Option;

$options = Option::with('description', 'values.description')->get();

foreach ($options as $option) {
    echo $option->description->name; // Color
    foreach ($option->values as $value) {
        $value->description->name; // Dark
    }
}
```

What about product options and option values? 

```php
use App\Models\Catalog\Product\Product;

$product = Product::with('options.values')->find(5);

foreach($product->options as $option) {
    echo $option->option->description->name; // Color
    foreach ($option->values as $value) {
        $value->value->description->name; // Grey
    }
}

// Be careful about (N+1) which opencart doesn't care at all...
```

Pagination

```php
use App\Models\Catalog\Manufacturer\Manufacturer;

$manufacturers = Manufacturer::with('description')
    ->paginate(
        $this->config->get('config_limit_admin'), 
        ['*'], 
        'page', 
        $this->request->get['page']
     );
 
//below lines belongs to opencart logic.  
$pagination = new \Pagination();
$pagination->total = $manufacturers->total();
$pagination->page = $manufacturers->currentPage();
$pagination->limit = $this->config->get('config_limit_admin');
$pagination->url = $this->url->link('extension/module/some_of_my_extensions/manufacturer', 'user_token=' . $this->session->data['user_token']. '&page={page}', true);
$pagination = $pagination->render();

$this->response->setOutput($this->load->view('extension/module/some_of_my_extensions', compact('manufacturers', 'pagination')))
  
```

Easy right? :) 

This project will be maintained as long as I continue to use OpenCart.




### WRITING YOUR EXTENSION MODELS

just put your models in your upload/app directory. 
Recommended way is follow opencart directory structure like:  
`app/Models/Extension/Module/ProductVideo.php`

```php
<?php
namespace App\Models\Extension\Module

use App\Models\Model;
use App\Models\Catalog\Product\Product;

class ProductVideo extends Model {
    private $table = DB_PREFIX.'product_video';
    private $primaryKey = 'product_video_id';
    
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id') 
    }
}
```

then in your module controller just call:

```php
use App\Models\Extension\Module\ProductVideo;

$video = ProductVideo::with('product')->first();
$video->product // Product object
```


### OCMOD SUPPORT
You can easily modify original model files without touching any vendor file.

Each Model has comment lines `//trait` at the beginning and `//ocmod` at the end. just search and add after whatever you want.


with below code you can use name property as mutator so instead `$product->description->name` you can use `$product->name`:

```xml
<file path="app/Models/Catalog/Product/Product.php">
    <operation>
        <search><![CDATA[//ocmod]]></search>
        <add position="after">
            <![CDATA[
            public function getNameAttribute() {
                return $this->description->name;
            }
            ]]>
        </add>
    </operation>
</file>
```

**RESULT**
```
$product->description->name // Ibanez RG35EX Black
$product->name              // Ibanez RG35EX Black
```

with below code you can do your modification with a trait.

```php
<?php
namespace App\Traits\Extension\Payment\MyModule\Traits\HasPrice;

trait HasPrice {
    public function getDiscountedPrice($percent = 20) {
        return $this->price * (100 - $percent) / 100;
    }
}
```

```xml
<file path="app/Models/Catalog/Product/Product.php">
    <operation>
        <search><![CDATA[//trait]]></search>
        <add position="after">
            <![CDATA[
            use \App\Traits\Extension\Payment\MyModule\Traits\HasPrice;
            ]]>
        </add>
    </operation>
</file>
```
**RESULT**
```
$product->price // 50
$product->getDiscountedPrice() // 40
$product->getDiscountedPrice(10) // 45
```

with below code you can create relation between opencart product model and your extension's model 

```xml
<file path="app/Models/Catalog/Product/Product.php">
    <operation>
        <search><![CDATA[//ocmod]]></search>
        <add position="after">
            <![CDATA[
            public function videos() {
                return $this->hasMany(\App\Models\Extension\Module\ProductVideo::class, 'product_id', 'product_id');
            }
            ]]>
        </add>
    </operation>
</file>
```

**RESULT**
```
$product = Product::with('videos')->first();
$product->videos()->first(); // Video model
```

modification file will be stored to `storage/modification/app/Models/Product/Product.php`