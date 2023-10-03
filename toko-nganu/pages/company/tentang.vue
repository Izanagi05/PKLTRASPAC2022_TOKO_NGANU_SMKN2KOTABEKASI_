<template>
  <div>
    <div class="container">
      <NavbarPolos />
      </div>
    <div style="height: 90vh;">
      <v-img :src="require('~/assets/home-img.png')" height="100%" width="100%" class="d-flex justify-center align-center">
        <div :class="[' d-flex justify-center font-weight-bold text-h4 text-md-h3 text-lg-h3']">
          Tentang Kami
        </div>
      </v-img>
    </div>
    <div class="container">
    <div :class="[' font-weight-bold text-center mt-8 text-h5 text-md-h4 text-lg-h4']">
        “Kami Melayani pembeli <br> meskipun permintaannya aneh-aneh”
      </div>
      <v-row class="mt-8">
        <v-col lg="6" md="6">
          <v-img :src="require('~/assets/rati.png')"  height="90%" width="90%" class="mx-auto rounded-xl align-center" />
        </v-col>
        <v-col lg="6" md="6" class="">
          <div>

            <p :class="[' font-weight-bold text-h5 text-md-h4 text-lg-h4']">
              Tentang Kami
            </p>
            <p class="text-justify text-subtitle-1" >
              Kami dengan bangga mempersembahkan kepada Anda pengalaman berbelanja yang tak tertandingi di toko online kami. Sebagai destinasi belanja terpercaya, kami telah berkomitmen untuk memberikan produk-produk berkualitas tinggi dengan harga yang kompetitif kepada pelanggan kam Di dalam toko online kami, Anda akan menemukan berbagai produk pilihan dalam berbagai kategori.
            </p>
            <v-btn class="rounded-pill white--text px-8"   color="#2f432d" >Kunjungi Toko</v-btn>
          </div>
        </v-col>
      </v-row>
            <p :class="[' font-weight-bold text-center mt-8', $vuetify.breakpoint.smAndDown?'text-h5 ':'text-h4 mt-']">
               Kenapa harus Kami?
              </p>
              <v-row class="  my-8 justify-space-between">
                <v-col cols="4">
                  <div :class="['hover-btnku shadow-xl text-center ',$vuetify.breakpoint.smAndDown?'pa-2 rounded-lg ':'rounded-xl pa-4']">
                    <v-icon color="black" :size="$vuetify.breakpoint.smAndDown?'60':'200'">mdi-truck-fast</v-icon>
                  <p :class="[' ma-0 font-weight-medium',$vuetify.breakpoint.smAndDown?'text-body-2':'text-body-1']">Cepat banget</p>
                </div>
              </v-col>

                <v-col cols="4">
                  <div :class="['hover-btnku shadow-xl text-center ',$vuetify.breakpoint.smAndDown?'pa-2 rounded-lg ':'rounded-xl pa-4']">
                    <v-icon color="black" :size="$vuetify.breakpoint.smAndDown?'60':'200'">mdi-truck-fast</v-icon>
                  <p :class="[' ma-0 font-weight-medium',$vuetify.breakpoint.smAndDown?'text-body-2':'text-body-1']">Cepat banget</p>
                </div>
              </v-col>

                <v-col cols="4">
                  <div :class="['hover-btnku shadow-xl text-center ',$vuetify.breakpoint.smAndDown?'pa-2 rounded-lg ':'rounded-xl pa-4']">
                    <v-icon color="black" :size="$vuetify.breakpoint.smAndDown?'60':'200'">mdi-truck-fast</v-icon>
                  <p :class="[' ma-0 font-weight-medium',$vuetify.breakpoint.smAndDown?'text-body-2':'text-body-1']">Cepat banget</p>
                </div>
              </v-col>


              </v-row>
    </div>
  </div>
</template>
<script>
export default {

}
</script>
