<template>
  <div class="">
    <div class="btn-warnaku white--text">
        <div class="py-1 font-weight-regular">
          <button class=" ml-4" type="submit" @click="kontak">
            <v-icon color="white">mdi-phone</v-icon>
            +62-815-6315-10389
          </button>
        </div>
      </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      no_admin: "6281563151038",
    };
  },
  methods: {
    kontak() {
      let nomer = this.no_admin;
      window.open("https://wa.me/" + nomer);
    },
  },
};
</script>

<style scoped>
/* .ppp {
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
} */
</style>
