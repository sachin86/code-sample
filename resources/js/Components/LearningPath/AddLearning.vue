<template>
    <!-- Main modal -->
    <div id="duplicatePath"
        class="bg-bgModal fixed top-0 flex items-center justify-center left-0 right-0 z-50 w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
        <div class="relative w-full h-auto max-w-2xl md:h-auto">
            <!-- Modal content -->
            <div class="relative rounded-lg shadow bg-body">
                <!-- Modal header -->
                <div class="flex items-start justify-between p-4 rounded-t">
                    <div>
                        <h3 class="text-xl font-semibold text-gray-300">
                            {{ trans('lang.labels.add_new_learning_path') }}
                        </h3>
                    </div>
                    <button type="button" @click="isCloseAdd()" class="">
                        <XCircleIcon class="h-9 w-9 text-white" aria-hidden="true" />
                    </button>
                </div>
                    <!-- Form start here -->
                    <div class="p-6 space-y-6 h-fit overflow-y-auto theme-modal-body">
                        <div class="grid md:grid-cols-1 sm:grid-cols-1 gap-3 mb-2">
                            <div class="theme-input">
                                <h5 class="text-base text-neutral-400 mb-3">{{ trans('lang.labels.please_enter_the_learning_path_title') }}</h5>
                                <div class="relative">
                                    <input type="text" id="title_path"
                                        class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-neutral-100 bg-sidebar rounded-lg border-1 border-transparent appearance-none
                                                                            dark:focus:border-amber-500 focus:outline-none focus:ring-0 focus:border-amber-500 peer"
                                        placeholder=" " v-model="form.title" />
                                    <label for="title_path" class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75
                                                                            top-2 z-10 origin-[0] bg-sidebar px-2 peer-focus:px-2 peer-focus:text-amber-500 peer-focus:dark:text-amber-500
                                                                            peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75
                                                                            peer-focus:-translate-y-4 left-1">
                                        {{ trans('lang.labels.title') }}
                                    </label>
                                </div>
                                <span v-if="errors.title" class="mt-2 text-sm text-red-600">{{
                                            errors.title[0]
                                        }}</span>
                            </div>
                            <div class="relative">
                                <ckeditor class="identify_desc" :editor="editor" v-model="form.description"
                                    :config="editorConfig" tag-name="textarea"
                                    placeholder="What is the current situation/issue?"></ckeditor>
                            </div>
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="flex items-center justify-end p-6 space-x-2 rounded-b dark:border-gray-600">
                        <button @click="isCloseAdd()"
                            class="text-btnCancelText bg-btnCancelBg rounded-lg text-sm font-medium px-5 py-2.5">
                            {{ trans('lang.modal.cancel') }}
                        </button>
                        <button :disabled="formProcess" @click="submitForm()" class="text-btnSubmitText bg-btnSubmitBg rounded-lg text-sm font-medium px-5 py-2.5">
                            {{ trans('lang.modal.add') }}
                        </button>
                    </div>
            </div>
        </div>
    </div>
</template>
<script>
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import axios from 'axios';
import { mapStores } from 'pinia'
import { useAppStore } from "@/store";
import {
   XCircleIcon
} from '@heroicons/vue/24/solid'
export default {
    name: 'DuplicatePath',
    props: ['data'],
    components:{
        XCircleIcon
    },
    data() {
        return {
            addPath: {
                title: '',
                desc:''
            },
            form: {
            },
            errors: {
                title: '',
            },
            formProcess: false,
            selectedForms: [],
            editor: ClassicEditor,
            editorData: '<p>Content of the editor.</p>',
            editorConfig: {
                toolbar: ['heading', 'bold', 'italic', '|', 'NumberedList', 'BulletedList']
            },
        }
    },
    methods: {
        isCloseAdd() {
            this.$emit("closeAdd");
        },
        submitForm() {
            const config = {
                headers: {
                    'content-type': 'multipart/form-data'
                }
            }
            this.formProcess = true;
            // let formData = this.convertJsonToFormData(this.form);
            // console.log(formData);
            axios.post('/api/create-learning-path',this.form, config)
                .then((res) => {
                    if (res.status == 200) {
                        this.form = {};
                        this.isCloseAdd();
                        let notification = {
                        heading: 'success',
                        subHeading: res.data.message,
                        type: "success",
                        };
                        this.appStore.setNotification(notification);
                    }
                })
                .catch((error) => {
                    this.errors = error.response.data.errors;
                }).finally(() => {
                    this.formProcess = false;
                    //Perform action in always
                    document.body.style.overflow = '';
                });
        }
    },
    created() {
        // this.assignModule();
    },
    computed: {
        ...mapStores(useAppStore),
    },
}
</script>
