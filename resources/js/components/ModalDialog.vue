<template>
    <div>
        <slot name="activator" :onClick="open"></slot>
        <div class="modal fixed w-full inset-0 z-50 overflow-hidden flex-col justify-center items-center animated fadeIn faster" :class="{ flex: isOpen, hidden: !isOpen }" style="background: rgba(0,0,0,.7);">
            <div class="shadow-lg modal-container bg-white w-11/12 sm:w-10/12 md:w-8/12 lg:w-6/12 xl:w-4/12 mx-auto rounded-xl shadow-lg z-50">
                <div class="modal-content py-4 text-left px-6">
                    <!--Title-->
                    <div class="flex justify-between items-center pb-3">
                        <slot name="header">
                            <p class="text-2xl font-bold text-gray-500">{{ title }}</p>
                        </slot>
                        <div class="modal-close cursor-pointer z-50 text-gray-600" @click="close">
                            <font-awesome-icon icon="times"></font-awesome-icon>
                        </div>
                    </div>
                    <form :method="formmethod" :action="formaction" class="w-full">
                        <csrf-token />
                        <!--Body-->
                        <div class="py-5">
                            <slot></slot>
                        </div>
                        <!--Footer-->
                        <div class="flex justify-end pt-2">
                            <submit-button class="bg-white border-gray-300 text-gray-500 hover:bg-gray-200 active:bg-gray-200" @click.prevent="close">Abbrechen</submit-button>
                            <slot name="submit">
                                <submit-button class="ml-3 bg-blue-800 border-transparent text-white hover:bg-blue-700 active:bg-blue-900" @click="close">OK</submit-button>
                            </slot>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import SubmitButton from './SubmitButton'
import CsrfToken from './CsrfToken'
export default {
    name: 'ModalDialog',
    components: { CsrfToken, SubmitButton },
    props: {
        title: { type: String, default: '' },
        formmethod: { type: String, default: 'POST' },
        formaction: { type: String, default: '' },
    },
    data: () => ({
        isOpen: false
    }),
    methods: {
        open () {
            this.isOpen = true
        },
        close () {
            this.isOpen = false
        }
    }
}
</script>
