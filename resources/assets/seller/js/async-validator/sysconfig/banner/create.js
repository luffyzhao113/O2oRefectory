
export const Validator = (data) => {

    return {
        name: [
            {required: true, type: 'string', message: '横幅名称不能为空', trigger: 'blur'},
            {type: 'string', min: 2, max: 50, message: '横幅名称必须在 2 到 50 个字符之间', trigger: 'blur'}
        ],
        position: [
            {required: true, type: 'string', message: '横幅位置不能为空', trigger: 'blur'},
            {type: 'string', min: 2, max: 10, message: '横幅位置必须在 2 到 10 个字符之间', trigger: 'blur'},
            {message: '横幅位置只能包含数字和字母“-”，“_”。', trigger: 'blur', pattern: /[a-z]+[a-z0-9\-_]*/i},
        ],
        status: [
            {required: true, type: 'number', message: '横幅状态不能为空', trigger: 'change'}
        ]
    }
}