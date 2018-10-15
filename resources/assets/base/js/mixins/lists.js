import http from "./http";
import comp from "./comp";

export default {
    mixins: [http, comp],
    data() {
        return {
            searchForm: {},
            data: {
                data: [],
                page: {
                    total: 0,
                    current: 1,
                    page_size: 20
                }
            }
        }
    },
    mounted() {
        this.$nextTick(() => {
            this.search()
        });
    },
    methods: {
        search(page = 1) {},
        assignmentData(data) {
            this.data.data = data.data;
            this.data.page.total = data.total
            this.data.page.current = data.current_page
            this.data.page.page_size = data.per_page
        },
        destroyItem(row, url) {
            this.$http.delete(url).then((res) => {
                this.search()
            }).catch((res) => {
                this.formatErrors(res)
            });
        },
        request(page) {
            let searchForm = JSON.parse(JSON.stringify(this.searchForm));
            searchForm.page = page
            return searchForm;
        }
    }
}