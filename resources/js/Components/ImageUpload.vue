<script setup>
import { ref } from "vue";

const emit = defineEmits(['image']);

const props = defineProps({
  deskImage: String
});

const currentImage = props.deskImage
  ? `/storage/${props.deskImage}`
  : null;

const preview = ref(currentImage);
const oversizedImage = ref(false);

const imageSelected = (e) => {
  preview.value = URL.createObjectURL(e.target.files[0]);
  oversizedImage.value = e.target.files[0].size > 3145728;
  emit('image', e.target.files[0])
};
</script>

<template>
  <div>
    <span
      class="block text-sm font-semibold text-slate-400"
      :class="{'!text-red-500' : oversizedImage}"
    >
      {{
        oversizedImage
          ? "The selected image exceeds 3Mb"
          : "Image (Max size 3Mb)"
      }}
    </span>

    <label
      for="image"
      class="block rounded-3xl mt-1 bg-white/5 h-[140px] overflow-hidden cursor-pointer border-slate-500 border text-6xl font-semibold text-slate-400 text-center"
      :class="{'!border-red-500 !border-2' : oversizedImage}"
    >  
    <img v-if="preview"
        :src="preview"
        class="object-cover object-center h-full w-full"
        alt=""
      />
    <i v-else class="fa-regular fa-images py-10"></i>
  </label>

    <input
      @input="imageSelected"
      type="file"
      name="image"
      id="image"
      hidden
    />
  </div>
</template>