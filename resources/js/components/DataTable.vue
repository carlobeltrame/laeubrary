<template>
    <div class="w-full max-w-full overflow-x-auto">
        <table class="w-full" :class="tableClass">
            <thead>
            <tr class="hidden md:table-row">
                <th v-for="col in columns" :key="col.name" class="py-3 px-6 text-left sticky top-0 bg-brown-100 text-gray-600 uppercase text-sm leading-normal z-10" :class="col.headerClasses">{{ col.label }}</th>
            </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">
            <tr v-for="row in data" :key="row.id" class="md:hover:bg-gray-100 hoverable-tr block md:table-row mb-6 md:mb-0 border border-gray-200 shadow md:border-none md:shadow-none">
                <template v-for="col in columns">
                    <td :key="col.name" class="text-left whitespace-nowrap bg-white md:border-b md:border-gray-200 block md:table-cell w-full" :class="{ [col.classes]: true, 'py-3 px-6': !col.href }" :data-label="col.label">
                        <a v-if="col.href" class="py-3 px-6 block w-full h-full" :href="col.href(row)">
                            <slot :name="kebabCase(col.name)" :row="row">{{ row[col.name] }}</slot>
                        </a>
                        <slot v-else :name="kebabCase(col.name)" :row="row">{{ row[col.name] }}</slot>
                    </td>
                </template>
            </tr>
            </tbody>
        </table>
    </div>
</template>
<script>
import { kebabCase } from 'lodash'

export default {
    name: 'DataTable',
    components: {},
    props: {
        data: { type: Array, default: [] },
        columns: { type: Array, required: true },
        tableClass: { type: String, default: '' },
    },
    methods: { kebabCase }
}
</script>
<style>
.bg-brown-100 {
    background-color: rgb(255, 199, 150);
}
@media (min-width: 768px) {
    tr.hoverable-tr td {
        background-color: rgba(255, 255, 255, 1);
    }
    tr.hoverable-tr:hover td {
        background-color: rgba(243, 244, 246, 1);
    }
}
@media (max-width: 767px) {
    td:before {
        content: attr(data-label) "\a";
        white-space: pre;
        font-weight: bold;
    }

    td .inset-0 {
        top: 1.5rem;
    }
}
</style>
