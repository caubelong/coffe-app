<template>
  <div class="container mt-4 p" id="main-wrap">
    <div class="row">
      <h5 class="col-12 text-uppercase text-center text-header">Contact Us</h5>
    </div>
  </div>
  <div class="banner">
    <img :src="require('../../dist/banner-contact.jpg')" alt="" />
  </div>
</template>

<script>
export default {
  name: "contact-comp",
};
</script>

<style scoped>
.text-header {
  font-weight: 800;
  font-size: 22px;
  color: #3c5e2c;
}
.banner img {
  width: 100%;
  height: 600px;
}
</style>
