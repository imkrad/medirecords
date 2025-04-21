<template>
    <b-modal v-model="showModal" style="--vz-modal-width: 900px;" header-class="p-3 bg-light" title="Add Checkup" class="v-modal-custom" modal-class="zoomIn" centered no-close-on-backdrop>
        <form class="customform">
            <BRow class="g-3 mt-n3">
                <div class="col-md-6 mt-0">
                    <label class="form-label">Type <span v-if="form.errors.type_id" class="text-danger" style="font-size: 9px;">({{form.errors.type_id}})</span></label>
                    <Multiselect :options="dropdowns.maternals" label="name" v-model="form.type_id" object :message="form.errors.type_id" placeholder="Select type" ref="multiselect1"/>
                </div>  
                <div class="col-md-6 mt-0">
                    <label class="form-label">Subtype <span v-if="form.errors.subtype_id" class="text-danger" style="font-size: 9px;">({{form.errors.subtype_id}})</span></label>
                    <Multiselect :options="filteredSubtypes" label="name" v-model="form.subtype_id" :message="form.errors.subtype_id" placeholder="Select subtype" ref="multiselect1"/>
                </div>  
                <template v-if="this.form.type_id">
                    <div class="col-md-3 mt-2" v-if="this.form.type_id.name == 'Micronutrient Supplementation'">
                        <label class="form-label">Count <span v-if="form.errors.count" class="text-danger" style="font-size: 9px;">({{form.errors.count}})</span></label>
                        <Multiselect :options="filteredCounts" label="name" v-model="form.count" :message="form.errors.count" placeholder="Select" ref="multiselect1"/>
                    </div>  
                    <div class="col-md-3 mt-2" v-if="this.form.type_id.name == 'Micronutrient Supplementation'">
                        <label class="form-label">Tablet Given<span v-if="form.errors.value" class="text-danger" style="font-size: 9px;">({{form.errors.value}})</span></label>
                        <input type="text" v-model="form.value" class="form-control bg-light border-0" placeholder="Please enter value">
                    </div>  
                    <div class="col-md-6 mt-2" v-if="this.form.type_id.name == 'Immunization Status'">
                        <label class="form-label">Count <span v-if="form.errors.count" class="text-danger" style="font-size: 9px;">({{form.errors.count}})</span></label>
                        <Multiselect :options="filteredCounts" label="name" v-model="form.count" :message="form.errors.count" placeholder="Select count" ref="multiselect1"/>
                    </div>  
                    <div class="col-md-6 mt-2" v-if="this.form.type_id.name == 'Prenatal Check-ups'">
                        <label class="form-label">Count <span v-if="form.errors.count" class="text-danger" style="font-size: 9px;">({{form.errors.count}})</span></label>
                        <Multiselect :options="filteredCounts" label="name" v-model="form.count" :message="form.errors.count" placeholder="Select count" ref="multiselect1"/>
                    </div> 
                    <div class="col-md-6 mt-2" v-if="this.form.type_id.name == 'Nutritional Assessment'">
                        <label class="form-label">Value <span v-if="form.errors.value" class="text-danger" style="font-size: 9px;">({{form.errors.value}})</span></label>
                        <input type="text" v-model="form.value" class="form-control bg-light border-0" placeholder="Please enter value">
                    </div>  
                    <div class="col-md-6 mt-2" v-if="this.form.type_id.name == 'Infectious Disease Surveillance' || this.form.type_id.name == 'Laboratory Screening'">
                        <label class="form-label">Result <span v-if="form.errors.value" class="text-danger" style="font-size: 9px;">({{form.errors.value}})</span></label>
                        <Multiselect :options="['Positive','Negative']" label="name" v-model="form.value" :message="form.errors.value" placeholder="Select value" ref="multiselect1"/>
                    </div>  
                </template>
                <div class="col-md-6 mt-2">
                    <label class="form-label">Date <span v-if="form.errors.date_at" class="text-danger" style="font-size: 9px;">({{form.errors.date_at}})</span></label>
                    <input type="date" v-model="form.date_at" class="form-control bg-light border-0" placeholder="Please enter date_at">
                </div>     
                <template v-if="this.form.type_id">        
                <div class="col-md-12 mt-0">
                    <hr class="text-muted mt0 mb-0"/>
                </div>
                <div class="col-md-3 mt-2" v-if="this.form.type_id.name == 'Prenatal Check-ups'">
                    <label class="form-label">AOG in weeks</label>
                    <input type="text" v-model="form.additional_info.aog_week" class="form-control bg-light border-0" placeholder="Enter AOG in week">
                </div>
                <div class="col-md-3 mt-2" v-if="this.form.type_id.name == 'Prenatal Check-ups'">
                    <label class="form-label">Fetal Heart Rate</label>
                    <input type="text" v-model="form.additional_info.fetal_heart_rate" class="form-control bg-light border-0" placeholder="Enter FHR">
                </div>
                <div class="col-md-3 mt-2" v-if="this.form.type_id.name == 'Prenatal Check-ups'">
                    <label class="form-label">Height (cm)</label>
                    <input type="text" v-model="form.additional_info.height" class="form-control bg-light border-0" placeholder="Enter height">
                </div>
                <div class="col-md-3 mt-2" v-if="this.form.type_id.name == 'Prenatal Check-ups'">
                    <label class="form-label">Weight (kg)</label>
                    <input type="text" v-model="form.additional_info.weight" class="form-control bg-light border-0" placeholder="Enter weight">
                </div>
                <div class="col-md-3 mt-2" v-if="this.form.type_id.name == 'Prenatal Check-ups'">
                    <label class="form-label">Blood Pressure</label>
                    <input type="text" v-model="form.additional_info.blood_pressure" class="form-control bg-light border-0" placeholder="Enter BP">
                </div>
                <div class="col-md-3 mt-2" v-if="this.form.type_id.name == 'Prenatal Check-ups'">
                    <label class="form-label">BP > 140? (Y/N)</label>
                    <input type="text" v-model="form.additional_info.bp_over_140" class="form-control bg-light border-0" placeholder="Enter Y or N" readonly>
                </div>
                <div class="col-md-3 mt-2" v-if="this.form.type_id.name == 'Prenatal Check-ups'">
                    <label class="form-label">Temperature</label>
                    <input type="text" v-model="form.additional_info.temperature" class="form-control bg-light border-0" placeholder="Enter Temperature">
                </div>
                <div class="col-md-3 mt-2" v-if="this.form.type_id.name == 'Prenatal Check-ups'">
                    <label class="form-label">Fever? (Y/N)</label>
                    <input type="text" v-model="form.additional_info.fever" class="form-control bg-light border-0" placeholder="Enter Y or N" readonly>
                </div>
                <div class="col-md-3 mt-2" v-if="this.form.type_id.name == 'Prenatal Check-ups'">
                    <label class="form-label">Fundal Height (cm)</label>
                    <input type="text" v-model="form.additional_info.fundal_height" class="form-control bg-light border-0" placeholder="Enter fundal height">
                </div>
                <div class="col-md-3 mt-2" v-if="this.form.type_id.name == 'Prenatal Check-ups'">
                    <label class="form-label">Abnormal Presentation? (Y/N)</label>
                    <input type="text" @input="validateYN($event, 'abnormal_presentation')" v-model="form.additional_info.abnormal_presentation" class="form-control bg-light border-0" placeholder="Enter Y or N">
                </div>
                <div class="col-md-3 mt-2" v-if="this.form.type_id.name == 'Prenatal Check-ups'">
                    <label class="form-label">FHT (bpm)</label>
                    <input type="text" v-model="form.additional_info.fht" class="form-control bg-light border-0" placeholder="Enter FHT BPM">
                </div>
                <div class="col-md-3 mt-2" v-if="this.form.type_id.name == 'Prenatal Check-ups'">
                    <label class="form-label">Edema? (Y/N)</label>
                    <input type="text" @input="validateYN($event, 'edema')" v-model="form.additional_info.edema" class="form-control bg-light border-0" placeholder="Enter Y or N">
                </div>
                <div class="col-md-3 mt-2" v-if="this.form.type_id.name == 'Prenatal Check-ups'">
                    <label class="form-label">Vaginal Bleeding? (Y/N)</label>
                    <input type="text" @input="validateYN($event, 'vaginal_bleeding')" v-model="form.additional_info.vaginal_bleeding" class="form-control bg-light border-0" placeholder="Enter Y or N">
                </div>
                <div class="col-md-3 mt-2" v-if="this.form.type_id.name == 'Prenatal Check-ups'">
                    <label class="form-label">Urinary Tract Infection? (Y/N)</label>
                    <input type="text" @input="validateYN($event, 'urinary_tract_infection')" v-model="form.additional_info.urinary_tract_infection" class="form-control bg-light border-0" placeholder="Enter Y or N">
                </div>
                <div class="col-md-3 mt-2" v-if="this.form.type_id.name == 'Prenatal Check-ups'">
                    <label class="form-label">Vaginal Infection? (Y/N)</label>
                    <input type="text" @input="validateYN($event, 'vaginal_infection')" v-model="form.additional_info.vaginal_infection" class="form-control bg-light border-0" placeholder="Enter Y or N">
                </div>
            </template>


                <div class="col-md-12 mt-0">
                    <hr class="text-muted mt0 mb-0"/>
                </div>
                <div class="col-md-12 mt-2">
                    <label class="form-label">Remarks <span v-if="form.errors.remarks" class="text-danger" style="font-size: 9px;">({{form.errors.remarks}})</span></label>
                    <textarea type="text" rows="3" v-model="form.remarks" class="form-control bg-light border-0" placeholder="Please enter remarks"/>
                </div>
            </BRow>
        </form>
        <template v-slot:footer>
            <b-button @click="hide()" variant="light" block>Cancel</b-button>
            <b-button @click="submit('ok')" variant="primary" :disabled="form.processing" block>Submit</b-button>
        </template>
    </b-modal>
</template>
<script>
import _ from 'lodash';
import { useForm } from '@inertiajs/vue3';
import Multiselect from "@vueform/multiselect";
import InputLabel from '@/Shared/Components/Forms/InputLabel.vue';
import TextInput from '@/Shared/Components/Forms/TextInput.vue';
export default {
    components: { Multiselect, InputLabel, TextInput },
    props: ['dropdowns'],
    data(){
        return {
            currentUrl: window.location.origin,
            form: useForm({
                id: null,
                count: null,
                value: null,
                type_id: null,
                subtype_id: null,
                date_at: null,
                remarks: null,
                additional_info: {
                    aog_week: '',
                    fetal_heart_rate: '',
                    height: '',
                    weight: '',
                    blood_pressure: '',
                    bp_over_140: '',
                    temperature: '',
                    fever: '',
                    fundal_height: '',
                    abnormal_presentation: '',
                    fht: '',
                    edema: '',
                    vaginal_bleeding: '',
                    urinary_tract_infection: '',
                    vaginal_infection: ''
                }
            }),
            subtypes: [],
            counts: [],
            list1: ['Td1/TT1','Td2/TT2','Td3/TT3','Td4/TT4','Td5/TT5'],
            list2: ['1st Trimester','2nd Trimester','3rd Trimester','4th Trimester'],
            list3: ['2nd Trimester','3rd Trimester','4th Trimester'],
            list4: ['1st Trimester'],
            list5: ['1st Trimester','2nd Trimester','3rd Trimester'],
            showModal: false
        }
    },
    computed: {
        filteredSubtypes() {
            if (!this.form.type_id) {
                return this.subtypes;
            }
            return this.dropdowns.submaternals.filter((subtype) => subtype.type === this.form.type_id.name);
        },
        filteredCounts() {
            if(this.form.subtype_id == '76'){
                return this.list1;
            }else if(this.form.subtype_id == '77'){
                return this.list2;
            }else if(this.form.subtype_id == '78'){
                return this.list3;
            }else if(this.form.subtype_id == '87'){
                return this.list4;
            }else if(this.form.type_id.value == '92'){
                return this.list5;
            }else{
                return [];
            }
        },
    },
    watch: {
        'form.type_id'(newVal) {
            if (newVal) {
                this.form.subtype_id = null;
                this.form.count = null;
                this.form.value = null;
            }
        },
        'form.subtype_id'(newVal) {
            if (newVal) {
                this.form.count = null;
                this.form.value = null;
            }
        },
        'form.additional_info.temperature'(newVal){
            if(newVal){
                if(newVal >= 37){
                    this.form.additional_info.fever = 'Y';
                }else{
                    this.form.additional_info.fever = 'N';
                }
            }
        },
        'form.additional_info.blood_pressure'(newVal){
            if(newVal){
                if(newVal > 140){
                    this.form.additional_info.bp_over_140 = 'Y';
                }else{
                    this.form.additional_info.bp_over_140 = 'N';
                }
            }
        }
    },
    methods: { 
        show(id){
            this.form.reset();
            this.form.id = id;
            this.showModal = true;
        },
        validateYN(event, key) {
    let val = event.target.value.toUpperCase();
    if (val === 'Y' || val === 'N') {
      this.form.additional_info[key] = val;
    } else {
      this.form.additional_info[key] = '';
    }
  },
        submit(){
            this.form.post('/checkup',{
                preserveScroll: true,
                onSuccess: (response) => {
                    this.$emit('update',true);
                    this.hide();
                },
            });
        },
        handleInput(field) {
            this.form.errors[field] = false;
        },
        hide(){
            this.form.reset();
            this.editable = false;
            this.showModal = false;
        }
    }
}
</script>
<style scoped>
.form-label {
    font-size: 12px;
    margin-bottom: 5px;
}
</style>