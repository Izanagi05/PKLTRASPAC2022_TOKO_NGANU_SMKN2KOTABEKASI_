<template>
  <div class="ppp">
    <div class="contact white--text">
      <div class="contact-text font-weight-regular">
        <div class="icon_telepon">
          <v-img :src="require('~/assets/telepon.png')"></v-img>
        </div>
        <div>+62-000-000-000</div>
      </div>
    </div>
  </div>
</template>

<script>
export default {};
</script>

<style>
.ppp {
  overflow: hidden;
  margin-bottom: 51px;
}
.html {
  background-color: #fff;
  overflow: hidden;
}
.contact {
  background: #2f432d;
  padding: 9px 123px 10px 123px;
}
.contact-text {
  display: flex;
  font-size: 16px;
  line-height: 24px;
}
.contact-text .icon_telepon {
  margin-right: 11px;
  margin-top: 3px;
}
.nama_toko {
  margin-top: 4px;
  margin-left: 33px;
  font-size: 24px;
  font-family: "Poppins", sans-serif;
  font-weight: 600;
}
</style>
