<div class="tab-pane tab-pane-box fade" id="create-history" role="tabpanel" aria-labelledby="create-history" tabindex="0">
  <div class="cp-title">
    <h2> {{trans("pages.user.credit_history_tab.credit_history")}}</h2>
  </div>
  <section class="credit-history-wrapper">
    <div class="container--box">
      <div class="card">
        <div class="card-header">
          <div class="credit-title">
            <h3>{{trans("pages.user.credit_history_tab.points_record")}}</h3>
          </div>
        </div>
        <div class="card-body">
          <table class="table">
            <thead>
              <tr>
                <th>{{trans("pages.user.credit_history_tab.serial_number")}}</th>
                <th>{{trans("pages.user.credit_history_tab.type")}}</th>
                <th>{{trans("pages.user.credit_history_tab.points")}}</th>
                <th>{{trans("pages.user.credit_history_tab.date_time")}}</th>
              </tr>
            </thead>

            <tbody>
            @forelse($transectionHistory as $key => $history )
              <tr>
                <td>{{++$key}}</td>
                <td>
                  <div class="point-data">{{!empty($history->credit) ? trans("global.credit") : trans("global.debit")}}</div>
                </td>
                <td>{{!empty($history->credit) ? $history->credit : $history->debit}}</td>
                <td>@formattedDateTime($history->created_at)</td>
              </tr>
            @empty
              <tr>
                <td colspan="5">{{trans("pages.user.credit_history_tab.Transection_not_find")}}</td>
              </tr>
            @endforelse
             
            </tbody>
          </table>
          <div class="center">
            <nav aria-label="Page navigation example">
              {{ $transectionHistory->links() }}
            </nav>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>