<template>
  <nav class="my-6">
    <ul class="flex space-x-4">
      <li>
        <NavLink class="text-blue-500 hover:underline" href="/"
        :active="$page.component === 'Home'"
          >Форма заявки</NavLink>
      </li>
      <li>
        <NavLink class="text-blue-500 hover:underline" href="/list"
        :active="$page.component === 'List'"
          >Список таблиц</NavLink>
      </li>
    </ul>
  </nav>
</template>

<script setup>
import NavLink from '../Shared/NavLink.vue';
</script>

<style lang="scss" scoped>
</style>
