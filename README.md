# MegaCollections
Collezione di snippet per MODX.

Porting dei comandi di php in snippet ed aggiunta di comandi speciali dedicati a modx.

Quasi tutti i comandi si possono usare come modificatori

I parametri seguono l'ordine utilizzato in php, (p1,p2,p3)
se utilizzato come modificatore parametri aggiuntivi sono separati con ||

es. 
```
[[mc_substr? &p1=`[[*pagetitle]]` &p2=`3` &p3=`6`]]

[[*pagetitle:mc_substr=`3||6`]]  
```

Per la documentazione completa di ogni comando si invita a visionare il commento iniziale dello snippet.

Le funzioni che trattano gli array (es. explode,implode,foreach) richiedono formato Json

------
## Comandi Speciali:


#### mc_mailantispam
protegge le email codificandole con doppia tecnologia, html+js

```
[[*mail:mc_mailantispam]]
[[mc_mailantispam? &mail=`test@example.com`]]

[[*mail:mc_mailantispam=`1`]]
[[mc_mailantispam? &mail=`test@example.com` &link=`1`]]

puoi specificare anche delle classi css per il tag
[[mc_mailantispam? &mail=`test@example.com` &link=`1` &class=`linkmail`]]

in determinate situazioni è necessario disattivare l'output in js
[[mc_mailantispam? &mail=`test@example.com` &link=`1` &js=`0`]]
```

#### mc_getfeedrss
legge un feed rss e genera un output

 [[mc_getfeedrss?
  &url=``
  &tpl=``
  &wrapperTpl=``
  &limit=``
  &offset=``
  $toPlaceholder=``
 ]]



------
#### mc_field
Recupera un campo da una risorsa: 
 
**&id** id della risorsa (se non specificato cerca di recuperare la isorsa corrente)

**&field** nome del campo, se non specificato prende pagetitle

**&default** valore da resistuire se non trova la risorsa o il campo ichiesto

**&parent** risale al genitore specificato di n volte

 ```
[[mc_field? &id=`1`]] - recupera il pagetitle della risorsa umero 1

[[mc_field? &id=`1` &field=`tvField`]] - recupera la tv variable ella risorsa 1

[[mc_field? &parent=`1`]] - recupera il page title della risorsa enitore di quella corrente
```

------
#### mc_ph
Consente di impostare, modificare od eliminare un placeholder

##### Set Placeholder
```
[[mc_ph? &var=`newvar` &val=`10`]]
[[mc_ph? &var=`newvar` &val=`10`]]
```

##### Set Json to Placeholders
```
[[mc_ph? &var=`color` &val=`["red","blue","brown"]` &prefix=`test_` &separator=`.`]]
create   text_color.1=red   test_color.2=blue   test_color.3=brown  

[[mc_ph? &var=`people` &val=`{"Joe":"male","Rose":"female"}`]]
create   people.Joe=male   people.Rose=female   

```

you can use parameter &where and &sort
```
[[mc_ph? &var=`people` 
          &where=`{"sex":"female"}`
          &sort=`{"name":"asc"}` 
          &val=`[{"name":"A","sex":"male"},{"name":"B","sex":"female"},{"name":"C","sex":"female"}]`
]]
```


##### Delete Placeholder 
```
[[mc_ph? &var=`newvar` &del=`1`]]
```


------
## Elaborazione JSON:

#### mc_json.sort
Sort json data, return json
Sort order: asc,desc,rand,random,ASC,DESC,RAND,RANDOM

```
[[+json:mc_json.sort=`{"name":"asc"}`]]

[[mc_json.sort? &json=`[{"name":"Joe","sex":"male"},{"name":"Rose","sex":"female"}]` &sort=`{"name":"asc"}`]]

[[mc_json.sort? &json=`[{"name":"A","sex":"male"},{"name":"B","sex":"female"},{"name":"C","sex":"female"}]` &sort=`{"sex":"ASC","name":"RANDOM"}`]]

```

------
#### mc_json.where

Filter json data, return json.
```
[[+json:mc_json.where=`{"sex":"male"}`]]

[[mc_json.where? &json=`[{"name":"Joe","sex":"male"},{"name":"Rose","sex":"female"}]` &where=`{"sex":"male"}`]]
```

------
## Completamento media source

#### mc_media.url

Completa l'url con la baseurl del relativo mediasource

From id of media source:
```
[[+tvImage:mc_media.url=`3`]]
[[mc_media.url? &val=`[[+tvImage]]` &id=`3`]]
```

From tv image:
```
[[+tvImage:mc_media.url=`tvName`]]
[[mc_media.url? &val=`[[+tvImage]]` &tv=`tvName`]]

```

------
## ENV Variable

#### mc_get, mc_post, mc_request
Recupera la variabile se impostanta altrimenti prende valore di default
```
[[!mc_get? &name=`nomevar` &default=``]]
[[!mc_post? &name=`nomevar` &default=``]]
[[!mc_request? &name=`nomevar` &default=``]]
```


------
## PHP Costrunct:

#### mc_if
```
[[*value:mc_if=`b`:then=``:else=``]]
[[*value:mc_if=`==||b`:then=``:else=``]]
[[*value:mc_if=`>||5`:then=``:else=``]]
```
```
[[mc_if? &p1=`a` &p2=`==` &p3=`b` &p4=`...then..` &p5=`..else..`]]

[[mc_if? &p1=`a` &p2=`==` &p3=`b` &then=`...then..` &else=`..else..`]]
```

------
#### mc_switch

```
[[mc_switch? &val=`10` 
    &if_1=`20` &then_1=`is 20` 
    &if_2=`9` &op_2=`>` &then_2=`greater of 9`  
    &if_NN=`...` &op_NN=`...` &then_NN=`...`  
    &default=`xxx` 
]]
```

------
#### mc_for

```
[[mc_for? &var=`x` &start=`1` &stop=`10` &inc=`1` &tpl=`tplfor`]]
```

------
#### mc_foreach

```
[[*json:mc_foreach=`key||value||tpl||tplempty`]]
```

```
[[mc_foreach? &p1=`[[*json]]` &p2=`key` &p3=`value` &p4=`tpl` &p5=`tplempty`]]
```

You can use where and sort parameter.

```
[[mc_foreach? &p1=`[[*json]]` &p2=`key` &p3=`value` &tpl=`tpl` &tplempty=`tplempty` &where=`` &sort=``]]
```



------

## PHP Function:

es. per usare la funzione trim
```
[[mc_trim? &p1=`  ciao  `]]
```
oppure è possibile richiamarla anche come modificatore
```
[[*pagetitle:mc_trim]]
```
per le funzioni con parametri, vediamo per esempio l'uso di substr
```
[[*pagatitle:mc_substr=`3`]]
[[mc_substr? &p1=`[[*pagatitle]]` &p2=`3`]]
```
es. con 2 o + parametri bisogna separarli con `||`
```
[[*pagatitle:mc_substr=`3||6`]]  
[[mc_substr? &p1=`[[*pagatitle]]` &p2=`3` &p3=`6`]]
```


mc_addslashes

mc_bin2hex

mc_chop

mc_chr

mc_chunk_split

mc_count_chars

mc_explode

mc_hex2bin

mc_implode

mc_join

mc_lcfist

mc_ltrim

mc_nl2br

mc_rtrim

mc_str_repeat

mc_stripos

mc_strpos

mc_strrev

mc_strripos

mc_strrpos

mc_strtolower

mc_strtoupper

mc_substr

mc_trim

mc_ucfist

mc_ucwords

mc_wordwrap




