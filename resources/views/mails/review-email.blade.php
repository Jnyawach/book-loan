<x-mail::message>
# Hi {{$user->name}}

A new detractor review has been submitted by a customer. See additional information below

<x-mail::panel>
# Customer Details:
Name: **{{$customer->name}}**<br>
Email: **{{$customer->email}}**<br>
Cellphone: **{{$customer->phone}}**
***
# Review Details:
Average rating: {{number_format($customer->answers->average('value'),1)}}<br><br>
@foreach($customer->answers as $answer)
{{$answer->question->quiz}} - **Response: {{$answer->value}}**<br>
@endforeach
</x-mail::panel>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
