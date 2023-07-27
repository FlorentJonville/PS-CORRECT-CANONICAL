<?php
class FrontController extends FrontControllerCore
{

    public function getTemplateVarPage()
    {
        $page_name = $this->getPageName();
        $meta_tags = Meta::getMetaTags($this->context->language->id, $page_name);

        $id_category = (int) Tools::getValue('id_category'); //OVERRIDE

        $my_account_controllers = array(
            'address',
            'authentication',
            'discount',
            'history',
            'identity',
            'order-follow',
            'order-slip',
            'password',
            'guest-tracking',
        );

        $body_classes = array(
            'lang-' . $this->context->language->iso_code => true,
            'lang-rtl' => (bool) $this->context->language->is_rtl,
            'country-' . $this->context->country->iso_code => true,
            'currency-' . $this->context->currency->iso_code => true,
            $this->context->shop->theme->getLayoutNameForPage($this->php_self) => true,
            'page-' . $this->php_self => true,
            'tax-display-' . ($this->getDisplayTaxesLabel() ? 'enabled' : 'disabled') => true,
        );

        if (in_array($this->php_self, $my_account_controllers)) {
            $body_classes['page-customer-account'] = true;
        }

        $page = array(
            'title' => '',
            //OVERRIDE
            'canonical' => isset($id_category) && $id_category ? $this->context->link->getCategoryLink($id_category, null, (int) Configuration::get('PS_LANG_DEFAULT')) : $this->getCanonicalURL(),
            //END OVERRIDE
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

        return $page;
    }

}
