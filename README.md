## Usage

- Khởi tạo đối tượng với đầu vào là  path local đến file hoặc 1 đường link web, cũng có thể là source/resource.


```
$image = new \Lego\ImageChecker\ImageChecker($path);
```

- Phát hiện format của file ảnh

```
$image->detectFormat();

```

Nếu check thành công sẽ trả ra định dạng của file nếu không sẽ in ra dòng thông báo
 
- Kiểm tra file ảnh riêng lẻ

```
$image->isGIF();
$image->isJPG();
$image->isPNG();

``` 


