<template>
  <div>

    <div class="container">
      <NavbarPolos />
      </div>
    <div style="height: 90vh;">
      <v-img :src="require('~/assets/home-img.png')" height="100%" width="100%" class="d-flex justify-center align-center">
        <div :class="[' d-flex justify-center font-weight-bold', $vuetify.breakpoint.smAndDown?'text-h4':'text-h3']">
        Kontak Kami
      </div>
    </v-img>
  </div>
  <div class="container">
    <v-row class="mt-8">
      <v-col cols="12" lg="6" md="6" sm="12" xs="12" class="pr-15">
        <div :class="[ 'grey--text font-weight-medium',  $vuetify.breakpoint.smAndDown?'text-h5  mt-2  mb-2':' text-h4  mt-4  mb-4']">
          Kontak kami
        </div>
        <p class="grey--text   ">
          consectetur adipiscing elit. Sed faucibus, justo eget condimentum cursus, justo risus semper nisl, ac tristique elit est id ante.
        </p>
        <v-row class="mt-4">
          <v-col cols="12" lg="6" md="6" v-for="(dt, i) in datakontak" :key="i">
            <div class="grey--text">
              <v-row>
                <v-col  cols="1" class="d-flex align-center" lg="12" md="12" sm="12" xs="2">
                  <v-icon :large="$vuetify.breakpoint.smAndDown?false:true" class="">{{dt.icon}}</v-icon>
                </v-col>
                <v-col cols="11" lg="12" md="12" sm="12" xs="10">

                  <div :class="['font-weight-medium text-lg-h6']">{{dt.jdl}}</div>
                  <div :class="['', $vuetify.breakpoint.smAndDown?'text-body-2':'text-body-1']">
                    {{ dt.isi }}
                  </div>
              </v-col>
              </v-row>
            </div>
          </v-col>
        </v-row>
      </v-col>
      <v-col cols="12" lg="6" md="6" sm="12" xs="12">
        <v-card class="px-10 py-8 shadow-xl rounded-xl d-flex justify-center ">
          <div>

            <div :class="[ 'grey--text font-weight-medium text-center',  $vuetify.breakpoint.smAndDown?'text-h6  mt-2  mb-2':' text-h4  mt-4  mb-4']">
              Kritik & Saran
          </div>
          <p :class="['grey--text text-center ', $vuetify.breakpoint.smAndDown?'text-body-2':'text-body-1']">Pendapat Anda sangat berharga bagi kami. Bagikan saran atau kritik Anda untuk membantu kami tumbuh.</p>
        <div class="mt-4">
          <v-text-field label="nama" />
          <v-text-field label="email" />
          <v-textarea rows="3" row-height="25" label="Isi" />

          </div>
          <div class="d-flex justify-center mt-2">
            <v-btn class="rounded-pill white--text px-15"   color="#2f432d" >Kirim</v-btn>
          </div>
        </div>
        </v-card>
      </v-col>
      </v-row>
    </div>
      <div class="mt-8">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1016874.8547641067!2d103.99220397812502!3d-5.391442399999988!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e40d1c779d44541%3A0xad484dcd1f3f0b16!2sTempat%20Susu%20Anime!5e0!3m2!1sid!2sid!4v1696139427337!5m2!1sid!2sid" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      datakontak:[
        {icon: 'mdi-email-multiple-outline', jdl:'Email', isi:'tokonganu@gmail.com'},
        {icon: 'mdi-map-marker-outline', jdl:'Alamat', isi:'Jl. NGANU, Bekasi Tenggara, Jawa Utara'},
        {icon: 'mdi-phone-outline', jdl:'Telephone', isi:'+62-812-2992-9828'},
        // {icon: 'mdi-map-marker-outline', jdl:'Alamat', isi:'Jl. NGANU, Bekasi Tenggara, Jawa Utara'},
      ]
    }
},

}
</script>
