# dump_product 
## listing of products:
```
curl -X GET http://localhost/dump_product/public/index.php/products
``` 
## add product (example):
```
curl -X PUT http://localhost/dump_product/public/index.php/product_add -H "Authorization: Basic Z3Vlc3Q6Z3Vlc3QxMjM=" -H "Content-Type: application/json" --data-binary @- <<DATA
 {
  "name": "Chopin: Nocturnes - Artur Rubinstein",
  "description": "CD Gandalf.com.pl",
  "price": "40",
  "model_year":"2010"
 }
DATA
 ```
#### Warning! If you miss one of four fields, it doesn't add a product but return code "404".

## edit product (example):
```
curl -X PUT http://localhost/dump_product/public/index.php/product_edit/1/ -H "Content-Type: application/json" --data-binary @- <<DATA
 {
  "description": "dwie płyty CD - szczegóły na stronie Gandalf.com.pl",
  "price": "140"
 }
DATA
```
## listing of products (example):
```
curl -X GET http://localhost/dump_product/public/index.php/products 
```
```
{
    "products": [{
       "id": 1,
        "name": "Chopin: Nocturnes - Artur Rubinstein",
        "price": 3949,
        "description": "CD Gandalf.com.pl",
        "model_year": 2010
    }]
}
```
## remove product (example)
```
curl -X DELETE http://localhost/dump_product/public/index.php/product_remove/1/ 
```
