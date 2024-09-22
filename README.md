
## Kurulum

Önce projeyi indirin

```bash
  git clone https://github.com/varisatasoy/case-solution.git
  cd case-solution
```
Projeyi ayağa kaldırın :

```bash
  docker-compose build
  docker-compose up -d
```

Sonra Container içine giriniz :


```bash
  docker exec -it case_solution bash
```

Gerekli dosyaların yüklenmesi:

```bash
  composer install
```

Tablolarin oluşturulması:

```bash
  php artisan migrate
```
Veritabanına örnek kayıtların eklenmesi :

```bash
  php artisan db:seed
```
## API End-Points

#### Sipariş oluşturma

```http
  POST http://localhost:9000/api/orders
```

| Parametre | Tip     | Açıklama                |
| :-------- | :------- | :------------------------- |
| `customer` | `int` | **Required**  |
| `items` | `array` | **Required**  |


## örnek data

```json
{
    "customer": 1,
    "items": [
        {
            "product_id": 10,
            "quantity": 6
        },
        {
            "product_id": 12,
            "quantity": 10
        }
    ]
}

```

#### Sipariş listeleme

```http
  GET http://localhost:9000/api/orders
```


#### Sipariş silmne

```http
  DELETE http://localhost:9000/api/orders/id
```

| Parametre | Tip     | Açıklama                |
| :-------- | :------- | :------------------------- |
| `id` | `int` | **Required**  |


#### Sipariş indirimler listesi

```http
  GET http://localhost:9000/api/discounts
```






