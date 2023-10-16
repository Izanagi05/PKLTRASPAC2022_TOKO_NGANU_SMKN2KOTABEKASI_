<template>
  <div style="overflow-x: none;">

    <div class="container">
      <NavbarPolos />
      <div class="text-h5 text-lg-h4 font-weight-bold text-md-h4 text-center">
        Pertanyaan? Lihat disini
      </div>
      <v-row class="mt-8">
        <v-col cols="12" lg="3" md="3" sm="12" xs="12">
          <div>
            <p class="font-weight-bold text-h6 ">
              Pertanyaan lain
            </p>
            <div v-for="(tagpert, i) in tagpertanyaan" :key="i">
              <a  :href="'/faqs#'+tagpert.jdlpert" id="scrollButton"  :class="['text-body-1 text-decoration-none black--text']">{{ tagpert.jdlpert }}</a>
              <div v-if="$vuetify.breakpoint.smAndDown"  class="rounded-xl mt-4" style="border-bottom: black 2px solid;"></div>
            </div>
          </div>
        </v-col>
        <v-col cols="12" lg="9" md="9" sm="12" xs="12" style="height:80vh;overflow-y: scroll;transition: 2s ease-in-out;" >
          <div id="tujuanGulir" v-for="(dttag, i) in tagpertanyaan" :key="i">
            <div :id="dttag.jdlpert" :ref="dttag.jdlpert" class="mb-8">
              <p class="font-weight-medium text-h6 mb-4">{{ dttag.jdlpert }}</p>
              <v-expansion-panels v-model="panel" flat>
                <v-expansion-panel v-for="(dt, i) in dttag.pertanyaanjawaban" :key="i" v-model="panel">
                  <v-expansion-panel-header>
                    <div class="font-weight-medium text-body-1">
                      {{ dt.pert }}
                      <div  class="rounded-xl mt-4" style="border-bottom: black 1px solid;"></div>
                  </div>
                </v-expansion-panel-header>
                  <v-expansion-panel-content>
              <p>
                {{ dt.jwbn }}
              </p>
              <!-- <p class="text-caption amber--text text-darken-4 ">
                Selengkapnya...
              </p> -->
            </v-expansion-panel-content>
          </v-expansion-panel>
        </v-expansion-panels>
              </div>
      </div>
        </v-col>
      </v-row>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      tagpertanyaan: [
        {
          jdlpert: "Akun",
          pertanyaanjawaban: [
            {
              pert: "Bagaimana cara membuat akun?",
              jwbn: "Kami dengan bangga mempersembahkan kepada Anda pengalaman berbelanja yang tak tertandingi di toko online kami. Sebagai destinasi belanja terpercaya, kami telah berkomitmen untuk memberikan produk-",
            },
            {
              pert: "Bagaimana cara membuat akun?",
              jwbn: "Kami dengan bangga mempersembahkan kepada Anda pengalaman berbelanja yang tak tertandingi di toko online kami. Sebagai destinasi belanja terpercaya, kami telah berkomitmen untuk memberikan produk-",
            },
            {
              pert: "Bagaimana cara membuat akun?",
              jwbn: "Kami dengan bangga mempersembahkan kepada Anda pengalaman berbelanja yang tak tertandingi di toko online kami. Sebagai destinasi belanja terpercaya, kami telah berkomitmen untuk memberikan produk-",
            },
            {
              pert: "Bagaimana cara membuat akun?",
              jwbn: "Kami dengan bangga mempersembahkan kepada Anda pengalaman berbelanja yang tak tertandingi di toko online kami. Sebagai destinasi belanja terpercaya, kami telah berkomitmen untuk memberikan produk-",
            },
            {
              pert: "Bagaimana cara membuat akun?",
              jwbn: "Kami dengan bangga mempersembahkan kepada Anda pengalaman berbelanja yang tak tertandingi di toko online kami. Sebagai destinasi belanja terpercaya, kami telah berkomitmen untuk memberikan produk-",
            },
          ],
        },
        {
          jdlpert: "Keranjang",
          pertanyaanjawaban: [
            {
              pert: "Bagaimana cara membuat akun?",
              jwbn: "Kami dengan bangga mempersembahkan kepada Anda pengalaman berbelanja yang tak tertandingi di toko online kami. Sebagai destinasi belanja terpercaya, kami telah berkomitmen untuk memberikan produk-",
            },
            {
              pert: "Bagaimana cara membuat akun?",
              jwbn: "Kami dengan bangga mempersembahkan kepada Anda pengalaman berbelanja yang tak tertandingi di toko online kami. Sebagai destinasi belanja terpercaya, kami telah berkomitmen untuk memberikan produk-",
            },
            {
              pert: "Bagaimana cara membuat akun?",
              jwbn: "Kami dengan bangga mempersembahkan kepada Anda pengalaman berbelanja yang tak tertandingi di toko online kami. Sebagai destinasi belanja terpercaya, kami telah berkomitmen untuk memberikan produk-",
            },
            {
              pert: "Bagaimana cara membuat akun?",
              jwbn: "Kami dengan bangga mempersembahkan kepada Anda pengalaman berbelanja yang tak tertandingi di toko online kami. Sebagai destinasi belanja terpercaya, kami telah berkomitmen untuk memberikan produk-",
            },
            {
              pert: "Bagaimana cara membuat akun?",
              jwbn: "Kami dengan bangga mempersembahkan kepada Anda pengalaman berbelanja yang tak tertandingi di toko online kami. Sebagai destinasi belanja terpercaya, kami telah berkomitmen untuk memberikan produk-",
            },
          ],
        },
        {
          jdlpert: "Barang",
          pertanyaanjawaban: [
            {
              pert: "Bagaimana cara membuat akun?",
              jwbn: "Kami dengan bangga mempersembahkan kepada Anda pengalaman berbelanja yang tak tertandingi di toko online kami. Sebagai destinasi belanja terpercaya, kami telah berkomitmen untuk memberikan produk-",
            },
            {
              pert: "Bagaimana cara membuat akun?",
              jwbn: "Kami dengan bangga mempersembahkan kepada Anda pengalaman berbelanja yang tak tertandingi di toko online kami. Sebagai destinasi belanja terpercaya, kami telah berkomitmen untuk memberikan produk-",
            },
            {
              pert: "Bagaimana cara membuat akun?",
              jwbn: "Kami dengan bangga mempersembahkan kepada Anda pengalaman berbelanja yang tak tertandingi di toko online kami. Sebagai destinasi belanja terpercaya, kami telah berkomitmen untuk memberikan produk-",
            },
            {
              pert: "Bagaimana cara membuat akun?",
              jwbn: "Kami dengan bangga mempersembahkan kepada Anda pengalaman berbelanja yang tak tertandingi di toko online kami. Sebagai destinasi belanja terpercaya, kami telah berkomitmen untuk memberikan produk-",
            },
            {
              pert: "Bagaimana cara membuat akun?",
              jwbn: "Kami dengan bangga mempersembahkan kepada Anda pengalaman berbelanja yang tak tertandingi di toko online kami. Sebagai destinasi belanja terpercaya, kami telah berkomitmen untuk memberikan produk-",
            },
          ],
        },
        {
          jdlpert: "Toko",
          pertanyaanjawaban: [
            {
              pert: "Bagaimana cara membuat akun?",
              jwbn: "Kami dengan bangga mempersembahkan kepada Anda pengalaman berbelanja yang tak tertandingi di toko online kami. Sebagai destinasi belanja terpercaya, kami telah berkomitmen untuk memberikan produk-",
            },
            {
              pert: "Bagaimana cara membuat akun?",
              jwbn: "Kami dengan bangga mempersembahkan kepada Anda pengalaman berbelanja yang tak tertandingi di toko online kami. Sebagai destinasi belanja terpercaya, kami telah berkomitmen untuk memberikan produk-",
            },
            {
              pert: "Bagaimana cara membuat akun?",
              jwbn: "Kami dengan bangga mempersembahkan kepada Anda pengalaman berbelanja yang tak tertandingi di toko online kami. Sebagai destinasi belanja terpercaya, kami telah berkomitmen untuk memberikan produk-",
            },
            {
              pert: "Bagaimana cara membuat akun?",
              jwbn: "Kami dengan bangga mempersembahkan kepada Anda pengalaman berbelanja yang tak tertandingi di toko online kami. Sebagai destinasi belanja terpercaya, kami telah berkomitmen untuk memberikan produk-",
            },
            {
              pert: "Bagaimana cara membuat akun?",
              jwbn: "Kami dengan bangga mempersembahkan kepada Anda pengalaman berbelanja yang tak tertandingi di toko online kami. Sebagai destinasi belanja terpercaya, kami telah berkomitmen untuk memberikan produk-",
            },
          ],
        },
        {
          jdlpert: "Beli barang",
          pertanyaanjawaban: [
            {
              pert: "Bagaimana cara membuat akun?",
              jwbn: "Kami dengan bangga mempersembahkan kepada Anda pengalaman berbelanja yang tak tertandingi di toko online kami. Sebagai destinasi belanja terpercaya, kami telah berkomitmen untuk memberikan produk-",
            },
            {
              pert: "Bagaimana cara membuat akun?",
              jwbn: "Kami dengan bangga mempersembahkan kepada Anda pengalaman berbelanja yang tak tertandingi di toko online kami. Sebagai destinasi belanja terpercaya, kami telah berkomitmen untuk memberikan produk-",
            },
            {
              pert: "Bagaimana cara membuat akun?",
              jwbn: "Kami dengan bangga mempersembahkan kepada Anda pengalaman berbelanja yang tak tertandingi di toko online kami. Sebagai destinasi belanja terpercaya, kami telah berkomitmen untuk memberikan produk-",
            },
            {
              pert: "Bagaimana cara membuat akun?",
              jwbn: "Kami dengan bangga mempersembahkan kepada Anda pengalaman berbelanja yang tak tertandingi di toko online kami. Sebagai destinasi belanja terpercaya, kami telah berkomitmen untuk memberikan produk-",
            },
            {
              pert: "Bagaimana cara membuat akun?",
              jwbn: "Kami dengan bangga mempersembahkan kepada Anda pengalaman berbelanja yang tak tertandingi di toko online kami. Sebagai destinasi belanja terpercaya, kami telah berkomitmen untuk memberikan produk-",
            },
          ],
        },
      ],
      panel:false,
    };
  },
  mounted() {
  //   document.getElementById("scrollButton").addEventListener("click", function() {
  //   document.getElementById("tujuanGulir").scrollIntoView({ behavior: "smooth" });
  // });

  },

  methods: {
    scrollToElement(id) {
      // Cari elemen dengan ref yang sesuai
      const element = this.$refs[id];
      if (element) {
        // Gulir ke elemen dengan animasi
        this.$refs.scrollContainer.scrollTo({
          top: element.offsetTop,
          behavior: 'smooth'
        });
      }
    }
}
}
</script>

<style scoped>
html {
  scroll-behavior: smooth;
}
</style>
