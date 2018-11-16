export const Validator = (data) => {
    return {
        name: [
            {required: true, type: 'string', message: '商品名称不能为空', trigger: 'blur'},
            {type: 'string', min: 2, max: 50, message: '商品名称必须在 2 到 20 个字符之间', trigger: 'blur'}
        ],
        bar_code: [
            {required: true, type: 'string', message: '商品条码不能为空', trigger: 'blur'},
            {min: 2, max: 20, message: '商品条码必须在 2 到 20 个字符之间', trigger: 'blur'}
        ],
        price: [
            {required: true, type: 'number', message: '商品价格不能为空', trigger: 'blur'},
            {pattern: /(^[1-9]\d*(\.\d{1,2})?$)|(^0(\.\d{1,2})?$)/, message: '商品价格格式不正确', trigger: 'blur'},
        ],
        stock: [
            {required: true, type: 'number', message: '商品库存不能为空', trigger: 'blur'},
            {pattern: /^[1-9]+[0-9]?$/, message: '商品库存格式不正确', trigger: 'blur'},
        ],
        sale: [
            {required: true, type: 'number', message: '商品销量不能为空', trigger: 'blur'},
            {pattern: /^[1-9][0-9]?$/, message: '商品销量格式不正确', trigger: 'blur'},
        ],
        is_sale: [
            {required: true, type: 'number', message: '商品是否上架不能为空', trigger: 'change'},
        ],
        category_id:[
            {required: true, type: 'number', message: '商品分类不能为空', trigger: 'change'},
        ],
        image: [
            {required: true, type: 'string', message: '商品主图不能为空', trigger: 'change'},
        ],
        images: [
            {required: true, type: 'array', min: 1, max: 10, message: '商品图片不能为空', trigger: 'change'},
        ]
    }
}