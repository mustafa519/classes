classes
=======

İhtiyacınız olabilecek bir takım sınıf dizileri yayınlanmaktadır.

### Paging

Paging sınıfı kullanımı;

Çağırıldı,
```
require 'Paging.php';
$Paging           = new Paging();
$Count            = mysql_fetch_assoc(mysql_query('select COUNT(`ID`) from `table` where `item` IS NOT NULL limit 1'));

```

**Not:** İsteyen PDO'ya da çevirilir fakat gelecekte desteklenmese de başlangıç seviyesi açısından "mysql_query" kullanılmıştır.

Ayarlandı,
```
$Paging->DATA     = array_pop($Count);  /* SQL'den dönen data alınır. Default: NULL */
$Paging->LIMIT    = 20;                 /* Her sayfada kaç adet kayıt listeleneceğini belirler. Default: 50 */
$Paging->DOTS     = true;               /* Yüksek adetli sayfalarda ilk/son sayfa ayıracı görüntülenme seçeneğidir. Default: true */
$Paging->ARROWS   = true;               /* Önceki(prev), Sonraki(next) işaretçileri için kullanılır. Default: true */
$Paging->WLIMIT   = 3;                  /* Sayfalama "padding" methodunu kullanır. Yani sağ ve sol görünecek sayfa adedidir. Default: 2 */
$Paging->CURRENT  = 1;                  /* Sayfalamanın başlıyacağı sayfayı belirtir. Default: 1 */
$Paging->SELECT   = true;               /* Sayfa uzadığında kolaylaştırma için selectbox ekler. Default: true */
$Paging->NAME     = 'pn';               /* GET ve/veya POST methoduyla alacağınız sayfalama veri belirtecidir. Default: 'pn' */

```

Oluşturuldu,
```
$SQL = mysql_query('select * from `table` where `item` IS NOT NULL order by `DATE` desc'. $Paging->limited());

```

HTML,
```
$Paging->template();

```

Genel
=======

Sınıf(lar)da herhangi bir lisans bulunmamakla birlikte istenildiği gibi kullanılmakta serbesttir.

Github kültürümü bağışlayın, rica edilmese bildiklerimi paylaşamamanın vicdanı olsa da bir türlü ısınamadım. Anlayışınız için teşekkürler.
