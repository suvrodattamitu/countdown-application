<template>
    <div>
        <el-row>
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

        <el-row>
            <el-col :span="12">
                <div class="nc_support_block">
                    <div class="support_block_header">
                        <h3>Recommended Plugins</h3>
                    </div> 
                    <div class="support_block_body">
                        <p>You can give a try too</p> 
                        <ul class="support_items">
                            <li>
                                <b>
                                    <a target="_blank" href="https://wordpress.org/plugins/fizzy-popups/">Fizzy Popups</a>
                                </b> - Fastest Popups Builder
                            </li> 
                            <li>
                                <b>
                                    <a target="_blank" href="https://wordpress.org/plugins/ninja-live-chat">Ninja Live Chat</a>
                                </b> - Fastest live chat Builder
                            </li>
                            <li>
                                <b>
                                    <a target="_blank" href="#">Fluent Feedback</a>
                                </b> - We are cooking Fluent Feedback. We will serve it HOT to you soon.
                            </li>
                        </ul>
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
            }
        }
    }
}
</script>