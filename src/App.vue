<template>
  <NcContent app-name="clubsuite-sepa">
    <NcAppNavigation>
      <NcAppNavigationItem
        name="Buchungen"
        href="/index.php/apps/clubsuite-finance/">
        <template #icon>
          <CashIcon :size="20" />
        </template>
      </NcAppNavigationItem>
      <NcAppNavigationItem
        :active="true"
        name="SEPA"
        href="/index.php/apps/clubsuite-sepa/">
        <template #icon>
          <BankIcon :size="20" />
        </template>
      </NcAppNavigationItem>
    </NcAppNavigation>
    <NcAppContent>
      <div class="sepa-container">
        <h2>SEPA Verwaltung</h2>
        <Mandates />
        <PaymentRuns />
      </div>
    </NcAppContent>
  </NcContent>
</template>

<script>
import { NcContent, NcAppContent, NcAppNavigation, NcAppNavigationItem } from '@nextcloud/vue'
import CashIcon from 'vue-material-design-icons/Cash.vue'
import BankIcon from 'vue-material-design-icons/Bank.vue'
import Mandates from './components/Mandates.vue'
import PaymentRuns from './components/PaymentRuns.vue'

export default {
  name: 'App',
  components: {
    NcContent,
    NcAppContent,
    NcAppNavigation,
    NcAppNavigationItem,
    CashIcon,
    BankIcon,
    Mandates,
    PaymentRuns
  }
}
</script>

<style scoped>
.sepa-container {
  padding: 20px;
}
</style>
