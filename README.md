# PS-CORRECT-CANONICAL-CATEGORY
Corrige le problème des urls canoniques dans la pagination des catégories sur Prestashop 1.7

```
$id_category = (int) Tools::getValue('id_category');
...
$page = array(
    'title' => '',
    'canonical' => isset($id_category) && $id_category ? $this->context->link->getCategoryLink($id_category, null, (int) Configuration::get('PS_LANG_DEFAULT')) : $this->getCanonicalURL(),
    'meta' => array(
        'title' => $meta_tags['meta_title'],
        'description' => $meta_tags['meta_description'],
        'keywords' => $meta_tags['meta_keywords'],
        'robots' => 'index',
    ),
    'page_name' => $page_name,
    'body_classes' => $body_classes,
    'admin_notifications' => array(),
);
```
        
Ajouter le fichier FrontController.php dans le dossier /override


