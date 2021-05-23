<template>
    <div class="w-full max-w-full overflow-x-scroll">
        <table class="table-auto w-full">
            <thead>
            <tr>
                <th v-for="col in columns" :key="col.name" class="py-3 px-6 text-left sticky top-0 bg-gray-200 text-gray-600 uppercase text-sm leading-normal z-10" :class="col.headerClasses">{{ col.label }}</th>
            </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">
            <tr v-for="row in data" :key="row.id" class="hover:bg-gray-100">
                <template v-for="col in columns">
                    <td v-if="col.href" :key="col.name" class="text-left whitespace-nowrap border-b border-gray-200" :class="col.classes">
                        <a class="py-3 px-6 block w-full h-full" :href="col.href(row)">
                            <slot :name="kebabCase(col.name)" :row="row">{{ row[col.name] }}</slot>
                        </a>
                    </td>
                    <td v-else class="py-3 px-6 text-left whitespace-nowrap border-b border-gray-200" :class="col.classes" :key="col.name">
                        <slot :name="kebabCase(col.name)" :row="row">{{ row[col.name] }}</slot>
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
    },
    methods: { kebabCase }
}
</script>
