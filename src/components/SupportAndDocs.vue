<template>
    <div class="nc-supportdocs">
        <el-row class="nc-docs-row">
            <el-col :span="24">
                <div class="nc-plugins-section">
                    <div class="text-group">
                        <h2>Are You Stuck ?</h2>
                        <p>Dont forget to let us know how can we help you.</p> 
                    </div>
                </div>
            </el-col>

            <el-col v-for="(item, i) in items" :key="i" :xs="24" :md="8">
              <div class="ninja_countdown_docs_wrap">
                <img :src="assets_url+item.img" alt="" />
                <div class="ninja_countdown_docs_title">
                  <h3>{{ item.title }}</h3>
                </div>
                <div class="ninja_countdown_docs_description">
                  <p>
                    {{ item.des }}
                  </p>
                  <a  v-if="item.url && item.url.length"
                      target="_blank"
                      class="el-button el-button--mini is-plain"
                      :href="item.url"
                      type="info"
                  >{{ item.btn }}</a
                  >

                  <div v-else class="support-mail">
                    <span>{{ item.email }}</span>
                  </div>
                </div>
              </div>
            </el-col>
        </el-row>


        <el-row class="nc-docs-row">
            <el-col :span="24">
                <div class="nc-plugins-section">
                    <div class="text-group">
                        <h2>Recommended Plugins</h2>
                        <p>You can give a try too our light weight , simple but powerful plugins.</p> 
                    </div>
                </div>
            </el-col>

            <el-col :span="24" :md="12" :lg="8" style="padding-left: 12px; padding-right: 12px;" v-for="(item, key) in plugins" :key="key">
                <div class="nc_card nc_card_s2 h-100 nc_addon_enabled_no">
                    <div class="nc_card_body mb-4">
                        <div class="nc_media_group mb-3">
                            <div class="nc_media_group_item mb-3">
                                <div class="nc_media_head">
                                    <div class="nc_icon_btn dark-soft md square">
                                        <img class="card-logo" :src="assets_url + item.logo">
                                    </div>
                                </div> 
                            
                                <div class="nc_media_body">
                                    <h4>{{ item.name }}</h4>
                                </div>
                            </div>

                            <div>
                                <a class="el-button el-button--mini is-plain" target="_blank" :href="item.url">
                                    Download Now
                                </a>
                            </div>
                        </div> 
                    
                        <p class="text">
                            {{ item.description }}
                        </p>
                    </div> 
                </div>
            </el-col>
        </el-row>
    </div>
</template>

<script type="text/babel">
export default {
    data() {
        return {
            assets_url: window.NinjaCountdownAdmin.assets_url,
            items: {
                support1: {
                    title: 'Need Help?',
                    des: 'Stuck with something? Get help from Our EXPERTS!',
                    url: '',
                    email: 'wplightplugins@gmail.com',
                    img: '/images/support/support.png',
                    btn: 'Contact Support'
                },
                support2: {
                    title: 'Love this Plugin?',
                    des: 'Please write a review. We appreciate it!',
                    url: 'https://wordpress.org/plugins/ninja-countdown/#reviews',
                    img: '/images/support/heart.png',
                    btn: 'Write a Review'
                },
                support3: {
                    title: 'Found a Bug?',
                    des: 'Please report us. We will fix it as soon as possible!',
                    url: 'https://github.com/wplightplugins/ninja-countdown-bugs/issues',
                    img: '/images/support/bug.png',
                    btn: 'Let us know'
                }
            },

            plugins: [
                // {
                //     name: 'Ninja Countdown',
                //     url: 'https://wordpress.org/plugins/ninja-countdown',
                //     logo: '/images/support/countdown.png',
                //     description: 'Fastest Countdown Builderr. Add FOMO Countdown and increase sales with beautiful timer.'
                // },
                {
                    name: 'Fizzy Popups',
                    url: 'https://wordpress.org/plugins/fizzy-popups',
                    logo: '/images/support/popup.png',
                    description: 'Fastest Popups Builder. Add FOMO Popup and increase sales with beautiful popup.'
                },
                {
                    name: 'Ninja Live Chat',
                    url: 'https://wordpress.org/plugins/ninja-live-chat',
                    logo: '/images/support/chats.jpg',
                    description: 'Fastest live chat Builder. Easily integrate WhatsApp to your website.'
                },
                {
                    name: 'Fluent Feedback',
                    url: '#',
                    logo: '/images/support/feedback.jpg',
                    description: 'We are cooking Fluent Feedback & will serve it HOT to you soon.'
                }
            ]
        }
    }
}
</script>