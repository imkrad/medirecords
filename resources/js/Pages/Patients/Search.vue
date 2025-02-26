<template>
    <b-modal v-model="showModal" style="--vz-modal-width: 700px;" header-class="p-3 bg-primary-subtle" title="Search Family Member" class="v-modal-custom" modal-class="zoomIn" centered no-close-on-backdrop>
        <BRow>
            <BCol lg="12" class="mt-0">
                <b-col lg>
                    <div class="input-group mb-1">
                        <span class="input-group-text"> <i class="ri-search-line search-icon"></i></span>
                        <input type="text" v-model="form.keyword" placeholder="Search using fullname or family number" class="form-control">
                    </div>
                </b-col>
                <hr class="text-muted mb-"/>
                <div class="table-responsive mt-2">
                    <table class="table table-nowrap align-middle mb-0">
                        <thead class="table-light">
                            <tr class="fs-11">
                                <td></td>
                                <td>Name</td>
                                <td class="text-center">Family Number</td>
                            </tr>
                        </thead>
                        <tbody v-if="names.length > 0">
                            <tr v-for="(list,index) in names" :key="index">
                                <td class="text-center"> 
                                    <input class="form-check-input me-1" v-model="form.code" name="method" type="radio" :value="list.code">
                                </td>
                                <td>{{ list.name }} <span class="text-muted fs-12">({{ list.type }})</span></td>
                                <td class="text-center">{{ list.code }}</td>
                            </tr>
                        </tbody>
                        <tbody v-else>
                            <tr>
                                <td colspan="4" class="text-center text-muted fs-12">No family member found.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </BCol>
        </BRow>
        <form class="customform">
            <div class="row g-3 mt-4">
                <BCol lg="12" class="mt-0 mb-n3"><hr class="text-muted"/></BCol>
                <BCol lg="8" style="margin-top: 13px; margin-bottom: -12px;" class="fs-12" :class="form.errors.has_member ? 'text-danger' : ''">
                    Have you found any family members?
                </BCol>
                <BCol lg="4" style="margin-top: 13px; margin-bottom: -12px;">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="custom-control custom-radio mb-3">
                                <input type="radio" id="customRadio1" class="custom-control-input me-2" @input="handleInput('has_member')" value="1" v-model="form.has_member">
                                <label class="custom-control-label fw-normal fs-12" for="customRadio1">Yes</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="custom-control custom-radio mb-3">
                                <input type="radio" id="customRadio2" class="custom-control-input me-2" @input="handleInput('has_member')" value="0" v-model="form.has_member">
                                <label class="custom-control-label fw-normal fs-12" for="customRadio2">No</label>
                            </div>
                        </div>
                    </div>
                </BCol>
                <BCol lg="12" class="mt-n2 mb-n3"><hr class="text-muted"/></BCol>
            </div>
        </form>
        <template v-slot:footer>
            <b-button @click="hide()" variant="light" block>Cancel</b-button>
            <b-button @click="submit()" variant="primary" :disabled="form.processing" block>Continue</b-button>
        </template>
    </b-modal>
</template>

<script>
import _ from 'lodash';
import { useForm } from '@inertiajs/vue3';
import Multiselect from "@vueform/multiselect";

export default {
    components: { Multiselect },
    data() {
        return {
            currentUrl: window.location.origin,
            form: useForm({
                code: null,
                keyword: null,
                has_member: null
            }),
            names: [],
            showModal: false,
            editable: false
        };
    },
    watch: {
        'form.keyword'(newVal) {
            this.checkSearch(newVal);
        },
        'form.has_member'(newVal) {
            this.emitData();
        },
        'form.code'(newVal) {
            if(newVal){
                this.form.has_member = 1;
            }
            this.emitData();
        }
    },
    methods: { 
        show() {
            this.form.reset();
            this.showModal = true;
        },
        checkSearch: _.debounce(function(string) {
            this.fetchNames(string);
        }, 300),
        fetchNames(code) {
            axios.get('/members', {
                params: {
                    option: 'names',
                    count: 5,
                    keyword: code
                }
            })
            .then(response => {
                this.names = response.data;
            })
            .catch(err => console.log(err));
        },
        emitData() {
            const payload = {
                has_member: this.form.has_member,
                code: this.form.has_member == '1' ? this.form.code : null
            };
            this.$emit('updateForm', payload);
        },
        submit() {
            if (this.form.has_member === null) {
                alert("Please select whether you found a family member.");
                return;
            }
            if (this.form.has_member === '1' && !this.form.code) {
                alert("Please select a family member.");
                return;
            }

            this.$emit('submitForm', {
                has_member: this.form.has_member,
                code: this.form.code
            });
            this.showModal = false;
        },
        handleInput(field) {
            this.form.errors[field] = false;
        },
        hide() {
            this.form.reset();
            this.editable = false;
            this.showModal = false;
        }
    }
};
</script>

<style scoped>
.form-label {
    font-size: 12px;
    margin-bottom: 5px;
}
</style>
