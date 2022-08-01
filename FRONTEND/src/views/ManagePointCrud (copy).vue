<template>
  <section style="width: 100%">
    <!-- <NavMain /> -->
    <v-content style="clear: both;padding: 2%;margin:0;width: 100%">
      <section class="breadCrumbsBox">
        <v-breadcrumbs :items="breadCrumbsData" large></v-breadcrumbs>
      </section>
      <section class="clearfix"></section>
      <br />
      <br />

      <v-card-title>
        <!-- Manage Documents -->
        <v-spacer></v-spacer>
        <v-text-field
          v-model="search"
          append-icon="mdi-magnify"
          label="Search"
          single-line
          hide-details
        ></v-text-field>
      </v-card-title>

      <v-alert type="success" v-show="showSuccessAlert">Voter validated, OTP sent!</v-alert>

      <sweetalert-icon icon="loading" v-show="showLoadingIcon" />

      <v-alert type="error" v-show="showErrorAlert">Unable to validate voter.</v-alert>

      <v-data-table
        :headers="headers"
        :items="recordsToDisplay"
        sort-by="name"
        class="elevation-1"
        :search="search"
        :loading="loadingPage"
        loading-text="Loading... Please wait"
      >
        <template v-slot:top>
          <v-toolbar flat color="white">
            <v-toolbar-title>
              <div class="d-flex grow flex-wrap">
                <div
                  class="text-start v-card--material__heading mb-n6 v-sheet theme--dark elevation-6 success pa-7"
                  style="max-height: 90px; width: auto;"
                >
                  <i
                    aria-hidden="true"
                    class="v-icon notranslate fa fa-users theme--dark"
                    style="font-size: 32px;"
                  ></i>
                  <!---->
                </div>
                <!---->
                <div class="ml-4">
                  <div
                    class="card-title font-weight-light"
                    style="margin-top:50px;"
                  >{{userData.name}} All Voters</div>
                </div>
              </div>
              <br />
              <v-spacer></v-spacer>
            </v-toolbar-title>
            <v-divider class="mx-4" inset vertical></v-divider>
            <v-spacer></v-spacer>
            <v-spacer></v-spacer>
            <v-dialog v-model="dialog" max-width="550px">
              <v-card>
                <v-card-title>
                  <span class="headline">{{ formTitle }}</span>
                </v-card-title>

                <v-card-text>
                  <v-container>
                    <v-row>
                      <v-card>
                        <v-card-title class="headline">Scan right index finger to validate voter.</v-card-title>
                        <v-card-text>An OTP will be sent your email address to be used for voting.</v-card-text>

                        <v-container class="grey lighten-5">
                          <v-row>
                            <v-col cols="12">
                              <v-card class="pa-2" outlined tile>
                                <v-text-field
                                  v-model="editedItem.mobileNumber"
                                  title="Voter mobile number"
                                  label="Mobile number"
                                  required
                                ></v-text-field>
                              </v-card>
                            </v-col>

                            <v-col cols="12">
                              <v-card class="pa-2" outlined tile>
                                <p class="text-muted">Right index finger</p>
                                <img
                                  class="img img-responsive dt-brand__logo-img"
                                  :src="scannedFingerSrc"
                                  v-bind:alt="appName"
                                  height="300"
                                  width="310"
                                  style="width: 180px;border-radius: 10px;box-shadow: 3px 3px 3px #333333;"
                                />

                                <p class="text-center">
                                  <v-badge :color="scanColor" :content="scanQuality">Scan Quality</v-badge>
                                </p>

                                <v-btn
                                  color="green"
                                  class="mr-4"
                                  style="margin-left: 20px;"
                                  @click="captureFP"
                                >
                                  <i class="fa fa-user"></i>&nbsp;
                                  Scan
                                </v-btn>
                              </v-card>
                            </v-col>
                          </v-row>
                        </v-container>
                      </v-card>
                    </v-row>
                  </v-container>
                </v-card-text>

                <v-card-actions>
                  <v-spacer></v-spacer>
                  <v-btn color="blue darken-1" text @click="close">Cancel</v-btn>
                  <v-btn color="blue darken-1" text @click="save">
                    <v-icon small class="mr-1">mdi-thumb-up</v-icon>Validate voter
                  </v-btn>
                </v-card-actions>
              </v-card>
            </v-dialog>
          </v-toolbar>
        </template>
        <template v-slot:item.actions="{ item }">
          <v-row justify="center">
            <v-btn type="button" @click="editItem(item)" color="success">
              <v-icon small class="mr-1">mdi-thumb-up</v-icon>Validate Voter
            </v-btn>
          </v-row>
        </template>
        <template v-slot:no-data></template>
      </v-data-table>
    </v-content>
    <Footer />
  </section>
</template>

<script>
// import axios from "axios";
import { manageVotersCrudMixin } from "../mixins/manageVotersCrudMixin.js";
import { appMixin } from "../mixins/appMixin.js";
import store from "../store";
// import NavMain from "../components/Navs/NavMain.vue";
import Footer from "../components/Footers/Footer.vue";

export default {
  name: "ManagePointCrud",
  mixins: [manageVotersCrudMixin, appMixin],
  components: {
    // NavMain,
    Footer
  },
  created: function() {
    // this.isLoggedIn();
    // let vmObjectInstance = this;

    let tempData = {
      responseCode: "00",
      responseMessage: "all voters information",
      data: [
        {
          firstName: "idisimagha",
          middleName: "bernard",
          surname: "dublin-green",
          mobileNumber: "07032090809",
          gender: "male",
          dateOfBirth: "03-05-1991",
          state: "rivers state",
          fingerPrint: "9394848489484jjjf8fjf848fjf48f"
        }
      ]
    };
    this.loadingPage = false;
    this.dataRecords = tempData.data;
    this.recordsToDisplay = this.dataRecords;
    
    // axios
    //   .get(this.endpoint)
    //   .then(function(response) {
    //     if (response.data.responseCode === store.state.successCode) {
    //       vmObjectInstance.userData = response.data.data;
    //       vmObjectInstance.loadingPage = false;
    //       vmObjectInstance.dataRecords = response.data.data;
    //       vmObjectInstance.recordsToDisplay = vmObjectInstance.dataRecords;
    //     }
    //   })
    //   .catch(function(error) {
    //     console.error(error);
    //   });
  },
  watch: {
    sendDocument(value) {
      this.shareDocumentDialog = false;
      if (value) {
        this.sendDocumentlink(this.currentItem);
      }
    }
  },
  data: function() {
    return {
      currentItem: null,
      sendDocument: false,
      loadingPage: true,
      appName: store.state.appName,
      mobileNumber: "",
      shareDocumentDialog: false,
      isLogin: store.state.isLogin,
      scanFingerBase: store.state.urlStore.scanFingerBase,
      scanFingerUrl: store.state.urlStore.scanFingerUrl,
      scannedFingerData: null,
      scannedFingerSrc: "/assets/images/PlaceFinger.bmp",
      scanQualityMinimum: 60,
      minimumMatchScore: 60,
      fingersMatch: false,
      returnMatchScore: 0,
      scanColor: "",
      scanQuality: 0,
      template_1: null,
      template_2: null,
      endpoint:
        store.state.urlStore.baseUrl + store.state.urlStore.getAllVoters,
      endpointValidateVoter:
        store.state.urlStore.baseUrl + store.state.urlStore.validateVoter,
      userData: { name: "" },
      breadCrumbsData: [
        {
          text: "Register",
          disabled: false,
          href: "#/RegisterVoters"
        },
        {
          text: "Manage Voters",
          disabled: true,
          href: "#/"
        }
      ]
    };
  },
  methods: {
   
  }
};
</script>
