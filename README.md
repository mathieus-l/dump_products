# dump_product 
# listing of products:
# curl -X GET http://localhost/dump_product/public/index.php/products 
# add product (example):
# curl -X PUT http://localhost/dump_product/public/index.php/product_add -H "Content-Type: application/json" --data-binary @- <<DATA
# {
#  "name": "Wiedźmin III",
#  "description": "Polska superprodukcja",
#  "price": "200",
#  "model_year":"2018"
# }
# DATA
# Warning! If you miss name/des
