<template>
  <div class="mt-10">
    <div class="pt-10 pb-2 green white--text px-5">
      <v-row class="mb-4 mx-8">
        <v-col
          cols="12"

          md="3"
          :class="['justify-center order-1 order-lg-1 order-md-1',$vuetify.breakpoint.lgAndUp ? 'col-lg-5' : '',]"
        >
          <div class="d-flex">
            <v-img
              :src="require('~/assets/logonganu-putih.png')"
              :max-width="$vuetify.breakpoint.smAndDown ? '20' : '30'"
            ></v-img>
            <div
              :class="[
                'font-weight-bold',
                $vuetify.breakpoint.smAndDown ? 'ml-2' : 'ml-4 text-h6',
              ]"
            >
              Toko nganu
            </div>
          </div>
          <div class="text-subtitle-1 mt-4">
            Temukan produk berkualitas dengan harga terbaik."
          </div>
        </v-col>
        <v-col cols="4" :class="[' order-2 order-lg-2 order-md-2',$vuetify.breakpoint.lgAndUp ? 'col-lg-5' : '']">
          <ul class="white--text list-none pa-0 text-decoration-none">
            <li class="font-weight-bold mb-2">Bantuan</li>
            <li v-for="(listbt, i) in listbantuan" :key="i" class="mb-2">
              <nuxt-link
                class="white--text list-none text-decoration-none"
                :to="listbt.bantuanlink"
                >{{ listbt.bantuantext }}</nuxt-link
              >
            </li>
          </ul>
        </v-col>
        <v-col cols="4"   md="2" :class="[' order-4 order-lg-3 order-md-3',$vuetify.breakpoint.lgAndUp ? 'col-lg-5' : '',]">
          <ul class="white--text list-none pa-0 text-decoration-none">
            <li class="font-weight-bold mb-2">Produk</li>
            <li v-for="(listbt, i) in listproduk" :key="i" class="mb-2">
              <nuxt-link
                class="white--text list-none text-decoration-none"
                :to="listbt.bantuanlink"
                >{{ listbt.bantuantext }}</nuxt-link
              >
            </li>
          </ul>
        </v-col>
        <v-col cols="8"  md="4" :class="[' order-5 order-lg-4 order-md-4',$vuetify.breakpoint.lgAndUp ? 'col-lg-5' : '',]">
          <div class="font-weight-bold">Ikuti Kami</div>
          <div class="d-flex">
            <v-icon color="white"> mdi-instagram </v-icon>
            <v-icon color="white"> mdi-instagram </v-icon>
            <v-icon color="white"> mdi-instagram </v-icon>
            <v-icon color="white"> mdi-instagram </v-icon>
            <v-icon color="white"> mdi-instagram </v-icon>
          </div>
          <div
            v-if="$vuetify.breakpoint.mdAndUp"
            class="text-subtitle-2 font-weight-regular"
          >
            Jelajahi Produk dan Layanan kami. Temukan solusi yang sesuai dengan
            kebutuhan Anda.
          </div>
        </v-col>
        <v-col cols="8"  md="2" :class="['order-3 order-lg-5 order-md-5',$vuetify.breakpoint.lgAndUp ? 'col-lg-5' : '',]">
          <div class="font-weight-bold">Alamat</div>
          <div class="d-flex">
            <v-icon> mdi-adress </v-icon>
            Jl. Nganu, Bekasi Tenggara, Jawa Utara
          </div>
        </v-col>
      </v-row>
      <div class="px-5">
        <div
          v-if="$vuetify.breakpoint.smAndDown"
          class="text-subtitle-2 font-weight-regular text-center"
        >
          Jelajahi Produk dan Layanan kami. Temukan solusi yang sesuai dengan
          kebutuhan Anda.
        </div>
        <hr class="my-2" />
        <div class="text-subtitle-2 font-weight-regular text-center">
          Copyright © 2020 Created by
          <span class="font-weight-bold"> Team Nganu </span>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      listbantuan: [
        { bantuanlink: "/company/tentang", bantuantext: "Tentang" },
        { bantuanlink: "/company/kontak", bantuantext: "Kontak Kami" },
        { bantuanlink: "/faqs", bantuantext: "FAQS" },
      ],
      listproduk: [
        { bantuanlink: "/keranjang", bantuantext: "Keranjang" },
        { bantuanlink: "/user-view/toko-user", bantuantext: "Toko saya" },
        { bantuanlink: "/user-view", bantuantext: "Akun saya" },
      ],
    };
  },
};
</script>
<style scoped>
.col-lg-5 {
  flex: 0 0 20%;
  max-width: 20%;
}
</style>
