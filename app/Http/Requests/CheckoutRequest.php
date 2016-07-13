<?php

namespace CodeDelivery\Http\Requests;

use Illuminate\Http\Request as HttpRequest;

class CheckoutRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(HttpRequest $request)
    {
        $rules = [
            'code'=>'exists:cupoms,code,used,0'
        ];

        $this->rulesItems(0,$rules);
        $items = $request->get('items',[]);
        $items = !is_array($items) ? [] : $items;
        foreach ($items as $key => $val){
            $this->rulesItems($key, $rules);
        }
        return $rules;
    }

    public function rulesItems($key, array &$rules)
    {
        $rules["items.$key.produto_id"] = 'required';
        $rules["items.$key.qtd"] = 'required';
    }
}
