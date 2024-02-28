<template>
  <Link
    class="text-blue-500 hover:underline"
    href="/"
    :class="{ 'font-bold underline': active }"
  >
    <slot />
  </Link>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
import { defineProps } from "vue";

const props = defineProps({
  active: {
    type: Boolean,
    default: false,
  },
});
</script>

<style lang="scss" scoped>
</style>
