<?php


namespace awe;


class JsonProductWriter extends ShopProductWriter
{
    public function write()
    {
        $json_str = '[';
        foreach ($this->products as $product) {
          $json_str .= $this->addEachProductAsJSON($product).',';
        }
        $json_str = rtrim($json_str, ","); //remove final ',' from outputted json string

        $json_str .= "]";
        echo $json_str;
    }

    private function addEachProductAsJSON($product){
        $json_product = [];
        $json_product['id'] = $product->getid();
        $json_product['title'] = $product->gettitle();
        $json_product['firstname'] = $product->getfirstname();
        $json_product['mainname'] = $product->getmainname();
        $json_product['price'] = $product->getprice();

        if($product instanceof BookProduct) {
            $json_product['numpages'] = $product->getnumberOfpages();
            $json_product['type'] = "book";
        }
        if($product instanceof CDProduct) {
            $json_product['playlength'] = $product->getPlayLength();
            $json_product['type'] = "cd";
        }

        return json_encode($json_product);
    }
}