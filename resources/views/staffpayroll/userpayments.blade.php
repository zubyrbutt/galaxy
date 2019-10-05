<h3>Payment Details of {{$user->fname}} {{$user->lname}} for Month {{$forMonth}}</h3>
<table class="table table-striped table-hover">
		<thead>
			<tr>
				<th>Date</th>
				<th>Description</th>
				<th>Amount</th>
				<th>Method</th>
				<th>Bank</th>
				<th>Cheque No</th>
				<th>Created By</th>
			</tr>
		</thead>
		<tbody>
			@foreach($payments as $payment)
			<tr>
				<td>{{$payment->created_at->format('d-M-Y')}}</td>
				<td>{{$payment->description}}</td>
				<td>{{$payment->amountpaid}}</td>
				<td>{{ucfirst($payment->paymentmethod)}}</td>
				<td>{{$payment->bank->bank_name}}</td>
				<td>{{$payment->chequeno}}</td>
				<td>{{$payment->createdby->fname}} {{$payment->createdby->lname}}</td>
			</tr>
			@endforeach
		</tbody>

</table>