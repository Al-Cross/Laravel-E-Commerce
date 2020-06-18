<script>
import FormError from './FormError';
import { Errors } from '../Errors';

export default {
    components: { FormError },

    props: ['categories', 'details', 'values'],

    data() {
        return {
            key: '',
            attributes: [],
            product: {
                name: '',
                description: '',
                price: '',
                sale_price: '',
                quantity: '',
                selected: [],
                attr_value: [],
                featured: 0
            },
            toggleInput: [],
            files: '',
            errors: new Errors()
        };
    },

    mounted() {
        if (this.details) {
            this.product.name = this.details.name;
            this.product.price = this.details.price;
            this.product.quantity = this.details.quantity;
            this.product.selected = this.values.map(value => value.id);

            if (this.details.sale_price) {
                this.product.sale_price = this.details.sale_price;
            }

            if (this.details.description) {
                this.product.description = this.details.description;
            }
        }
    },

    methods: {
        getCategories(event) {
            axios.get(`/admin/products/create/${event.target.value}`)
                .then(
                    response => this.attributes = response.data
                );
        },

        handleImagesUpload() {
            this.files = this.$refs.image.files;
        },

        createProduct() {
            if (window.location.pathname === '/admin/products/create') {
                axios.post('/admin/products', this.compile())
                    .then(response => window.location.href = response.data.redirect)
                    .catch(e => {
                        this.errors.record(JSON.parse(JSON.stringify(e.response.data.errors)));
                    });
            } else {
                axios.post(`/admin/products/${this.details.slug}/update`, this.compile())
                    .then(response => window.location.href = response.data.redirect)
                    .catch(e => {
                        this.errors.record(JSON.parse(JSON.stringify(e.response.data.errors)));
                    });
            }
        },

        /**
         * Prepapres all of the input data for the axios POST request.
         * @return FormData Object
         */
        compile() {
            let formData = new FormData();

            if (this.product.selected.length < this.attributes.length && this.product.attr_value.length == 0) {
                flash('Select values for all attributes.', 'danger');

                return
            }

            this.appends(formData, this.files, 'image[ ]');
            this.appends(formData, this.product.selected, 'select_value[ ]');
            this.appends(formData, this.product.attr_value, 'attr_value[ ]');

            if (this.details) {
                formData.append('_method', 'PATCH');
            }

            formData.append('category_id', this.key);
            formData.append('name', this.product.name);
            formData.append('description', this.product.description);
            formData.append('price', this.product.price);
            formData.append('sale_price', this.product.sale_price);
            formData.append('quantity', this.product.quantity);
            formData.append('featured', this.product.featured);

            return formData;
        },

        appends(formData, attribute, field) {
            let param = field.split(" ");
            let attributeId = this.attributes.map(a => a.id);

            if (attribute.length > 0) {
                for (var i = 0; i < attribute.length; i++) {
                    let value = attribute[i];

                    if (field !== 'attr_value[ ]') {
                        formData.append(param[0] + i + param[1], value);
                    } else if (value !== undefined) {
                        formData.append(param[0] + attributeId[i] + param[1], value);
                    }
                }
            }
        }
    }
};
</script>

<style>
    .select-css {
    display: block;
    font-size: 16px;
    font-family: sans-serif;
    font-weight: 700;
    color: #444;
    line-height: 1.3;
    padding: .6em 1.4em .5em .8em;
    width: 100%;
    max-width: 100%;
    box-sizing: border-box;
    margin: 0;
    border: 1px solid #aaa;
    box-shadow: 0 1px 0 1px rgba(0,0,0,.04);
    border-radius: .5em;
    -moz-appearance: none;
    -webkit-appearance: none;
    appearance: none;
    background-color: #fff;
    background-image: url('data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%22292.4%22%20height%3D%22292.4%22%3E%3Cpath%20fill%3D%22%23007CB2%22%20d%3D%22M287%2069.4a17.6%2017.6%200%200%200-13-5.4H18.4c-5%200-9.3%201.8-12.9%205.4A17.6%2017.6%200%200%200%200%2082.2c0%205%201.8%209.3%205.4%2012.9l128%20127.9c3.6%203.6%207.8%205.4%2012.8%205.4s9.2-1.8%2012.8-5.4L287%2095c3.5-3.5%205.4-7.8%205.4-12.8%200-5-1.9-9.2-5.5-12.8z%22%2F%3E%3C%2Fsvg%3E'),
      linear-gradient(to bottom, #ffffff 0%,#e5e5e5 100%);
    background-repeat: no-repeat, repeat;
    background-position: right .7em top 50%, 0 0;
    background-size: .65em auto, 100%;
    }
    .select-css::-ms-expand {
        display: none;
    }
    .select-css:hover {
        border-color: #888;
    }
    .select-css:focus {
        border-color: #aaa;
        box-shadow: 0 0 1px 3px rgba(59, 153, 252, .7);
        box-shadow: 0 0 0 3px -moz-mac-focusring;
        color: #222;
        outline: none;
    }
    .select-css option {
        font-weight:normal;
    }
</style>
