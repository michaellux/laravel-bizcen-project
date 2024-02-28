<template>
  <header>
    <h1 class="font-bold text-lg my-3">Bizcen test project</h1>
  </header>
  <Nav />
  <section class="p-6">
    <div class="max-w-3xl mx-auto">
      <slot />
    </div>
  </section>
</template>

<script setup>
import Nav from "./Nav.vue";
</script>

<style lang="scss" scoped>
</style>
