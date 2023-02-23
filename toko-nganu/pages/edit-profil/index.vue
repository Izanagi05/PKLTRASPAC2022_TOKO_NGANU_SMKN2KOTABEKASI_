<template>
  <div>
    <NavbarPolos2 />
    <div class="profil">
      <center>
        <div
          class="judul-page mt-5 mb-2 font-weight-bold"
          style="font-size: 20px; font-family: 'Poppins', sans-serif"
        >
          Edit Profil
        </div>
        <v-row class="isi">
          <v-col cols="6">
            <div class="foto-profil pl-5">
              <v-avatar width="270px" height="270px">
                <v-img :src="require('~/assets/barang.png')"></v-img>
              </v-avatar>
            </div>
            <div class="btn-card pl-1 pb-1 pt-3">
              <v-btn
                class="profil-btn rounded-pill font-weight-medium"
                width="310px"
                style="font-size: 24px; font-family: 'Poppins', sans-serif"
              >
                Pilih Foto
              </v-btn>
            </div>
          </v-col>
          <v-col cols="6">
            <v-row>
              <v-col cols="12" sm="3">
                <div class="nama pt-5 pb-5">Nama</div>
                <div class="alamat pb-5">Alamat</div>
                <div class="telepon pb-5">Telepon</div>
                <div class="email pb-5">E-Mail</div>
              </v-col>
              <v-col cols="12" sm="6">
                <div class="text-nama pt-5 pb-5">
                  <v-text-field
                    solo
                    v-model="nama"
                    label="Masukkan Nama"
                  ></v-text-field>
                </div>
                <div class="text-alamat pb-5">
                  <v-textarea
                    solo
                    v-model="alamat"
                    label="Masukkan Alamat"
                  ></v-textarea>
                </div>
                <div class="text-telepon pb-5">
                  <v-text-field
                    solo
                    v-model="telepon"
                    label="Masukkan No.Telepon"
                  ></v-text-field>
                </div>
                <div class="text-email pb-5">
                  <v-text-field
                    solo
                    v-model="email"
                    label="Masukkan Email"
                  ></v-text-field>
                </div>
              </v-col>
            </v-row>
            <div class="button pb-6 pt-5">
              <v-row>
                <v-col cols="4">
                  <div class="batal">
                    <v-btn class="rounded-pill" x-large outlined>Batal</v-btn>
                  </div>
                </v-col>
                <v-col cols="6">
                  <div class="bayar">
                    <v-btn
                      class="rounded-pill"
                      width="307px"
                      x-large
                      outlined
                      style="background: #2f432d; color: white; size: 105px"
                      >Simpan</v-btn
                    >
                  </div>
                </v-col>
              </v-row>
            </div>
          </v-col>
        </v-row>
      </center>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      nama: [],
      alamat: [],
      telepon: [],
      email: [],
    };
  },
};
</script>
<style>
.nama {
  margin-top: 10px;
  margin-bottom: 57px;
}
.alamat {
  margin-bottom: 150px;
}
.telepon {
  margin-bottom: 57px;
}
</style>
