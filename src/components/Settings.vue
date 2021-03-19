<template>
    <div class="ninja_countdown_settings_wrapper">

        <div class="ninja_settings_panel">
            <h2 class="ninja_header_text">Advance Settings</h2>

            <!--Save settings-->
            <el-row class="setting_header">
                <el-col :md="18">
                    <h2>
                        Global Settings
                        <el-tooltip class="item" effect="light" placement="bottom-start">
                            <template #content>
                                <h3>Error Message Placement</h3>
                                <p>These Settings will be used as default settings of a new form.<br/>You can customize layout settings for each page from form's settings page</p>
                            </template>
                            <i class="el-icon-info el-text-info"></i>
                        </el-tooltip>
                    </h2>
                </el-col>
            </el-row>

            <el-form ref="form-layout" label-position="left">
                <!--Label Placement-->
                <el-form-item>

                    <div>
                        <span>Global Settings</span>
                        <el-tooltip class="item" effect="light" placement="bottom-start">
                            <template #content>
                                <h3>Error Message Placement</h3>
                                <p>These Settings will be used as default settings of a new form.<br/>You can customize layout settings for each page from form's settings page</p>
                            </template>
                            <i class="el-icon-info el-text-info"></i>
                        </el-tooltip>
                    </div>

                    <div>
                        <el-checkbox :indeterminate="isIndeterminate" v-model="checkAll" @change="handleCheckAllChange">Check all</el-checkbox>
                        <div style="margin: 15px 0;"></div>
                        <el-checkbox-group v-model="checkedCities" @change="handleCheckedCitiesChange">
                            <el-checkbox v-for="city in cities" :label="city" :key="city">{{city}}</el-checkbox>
                        </el-checkbox-group>
                    </div>

                </el-form-item>

            </el-form>

            <!--Save settings-->
            <el-row>
                <el-col class="action-buttons clearfix mb15">
                    <el-button size="medium" class="pull-right" type="success" icon="el-icon-success">Save Settings</el-button>
                </el-col>
            </el-row>
        </div>

    </div>
</template>

<script>
  const cityOptions = ['Shanghai', 'Beijing', 'Guangzhou', 'Shenzhen'];
  export default {
    data() {
      return {
        checkAll: false,
        checkedCities: ['Shanghai', 'Beijing'],
        cities: cityOptions,
        isIndeterminate: true
      };
    },
    methods: {
      handleCheckAllChange(val) {
        this.checkedCities = val ? cityOptions : [];
        this.isIndeterminate = false;
      },
      handleCheckedCitiesChange(value) {
        let checkedCount = value.length;
        this.checkAll = checkedCount === this.cities.length;
        this.isIndeterminate = checkedCount > 0 && checkedCount < this.cities.length;
      }
    }
  };
</script>