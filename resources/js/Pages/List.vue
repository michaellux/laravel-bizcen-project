<template>
 <AppHead title="Список ссылок на google-таблицы" />
 <h1 class="text-4xl font-bold">Список ссылок на google-таблицы</h1>
 <ul class="space-y-2 mt-6">
    <li v-for="link in links" :key="link.id">
      <a class="text-blue-400 underline" :href="link.link" target="_blank">{{ link.spreadsheet_id }}</a>
    </li>
 </ul>
</template>

<script setup>
import AppHead from '../Shared/AppHead.vue'

// Assuming links are passed as a prop from the Laravel backend
const props = defineProps({
 links: Array
});
</script>

<style lang="scss" scoped>
</style>
