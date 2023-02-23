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
          <v-col>
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
          <v-col>
            <v-row>
              <div class="informasi">
                <div class="info-user">
                  <div class="nama pt-5">
                    <v-row>
                      <v-col cols="4"> Nama </v-col>
                      <v-col class="align-content-center" cols="8">
                        <v-text-field
                          v-model="nama"
                          label="Masukkan Nama"
                        ></v-text-field>
                      </v-col>
                    </v-row>
                  </div>
                  <div class="alamat pt-5">
                    <v-row>
                      <v-col cols="4">Alamat</v-col>
                      <v-col cols="8"
                        ><v-textarea
                          v-model="alamat"
                          label="Masukkan Alamat"
                        ></v-textarea
                      ></v-col>
                    </v-row>
                  </div>
                </div>
                <div class="info-kontak pt-6 pb-6">
                  <div class="telepon">
                    <v-row>
                      <v-col cols="4"> Telepon </v-col>
                      <v-col cols="8"
                        ><v-text-field
                          v-model="telepon"
                          label="Masukkan No.Telepon"
                        ></v-text-field
                      ></v-col>
                    </v-row>
                  </div>
                  <div class="email pt-5">
                    <v-row>
                      <v-col cols="4">E-Mail</v-col>
                      <v-col cols="8"
                        ><v-text-field
                          v-model="email"
                          label="Masukkan Email"
                        ></v-text-field>
                      </v-col>
                    </v-row>
                  </div>
                  <div class="button pb-6 pt-4">
                    <v-row>
                      <v-col cols="4">
                        <div class="batal">
                          <v-btn class="rounded-pill" x-large outlined
                            >Batal</v-btn
                          >
                        </div>
                      </v-col>
                      <v-col cols="6">
                        <div class="bayar">
                          <v-btn
                            class="rounded-pill"
                            width="307px"
                            x-large
                            outlined
                            style="
                              background: #2f432d;
                              color: white;
                              size: 105px;
                            "
                            >Simpan</v-btn
                          >
                        </div>
                      </v-col>
                    </v-row>
                  </div>
                </div>
              </div>
            </v-row>
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
