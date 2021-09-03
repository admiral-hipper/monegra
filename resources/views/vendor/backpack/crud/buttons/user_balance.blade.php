<a href="javascript:void(0)"
   class="btn btn-sm btn-link"
   onclick="openPopup({{ json_encode($entry) }})">
    <i class="la la-dollar"></i>

    <span>@lang('Replenishment')</span>
</a>

<script>
    async function openPopup({id, name, surname, email, balance_token: balanceToken}) {
        const content = document.createElement('div');

        const route = '{!! route('admin.user.replenishment') !!}',
            csrf = '{!! csrf_field() !!}';

        content.insertAdjacentHTML('afterbegin', `
            <div style="display: flex; flex-direction: column; justify-content: center;">
                <div style="padding: 8px 18px; text-align: left; font-size: 80%; background-color: rgb(255, 225, 151); border-radius: 10px;">
                    <span style="display: block; margin-bottom: 5px; font-weight: 600;">{!! __('admin.user') !!}</span>
                    <ul style="list-style: none; margin: 0; padding: 0; display: flex; flex-direction: column; align-items: flex-start;">
                        <li>ID: <strong>${id}</strong></li>
                        <li>{!! __('admin.name') !!}: <strong>${name} ${surname}</strong></li>
                        <li>{!! __('admin.email') !!}: <strong>${email}</strong></li>
                        <li>{!! __('admin.current_balance') !!}: <strong>${balanceToken}</strong></li>
                    </ul>
                </div>

                <form method="POST" action="${route}">
                    <div class="form-group" style="display: flex; margin-top: 12px;">
                        ${csrf}
                        <input type="hidden" name="user_id" value="${id}">
                        <input type="number" name="amount" class="form-control" min="0.00000001" step="0.00000001" placeholder="{!! __('admin.amount_in') !!} RTL">
                        <button type="submit" class="form-control btn waves-effect waves-light" style="background-color: #ffc107; color: #fff; font-weight: 600;">{!! __('admin.replenish') !!}</button>
                    </div>
                </form>
            </div>`
        );

        swal({
            icon: 'warning',
            title: "{!! __('admin.balance_replenishment_manually') !!}",
            content,
            buttons: false,
            closeOnClickOutside: false,
            closeOnEsc: false
        });
    }
</script>
