<h2>مرحباً {{ $user->name }} </h2>
<p>عندك المهام التالية مستحقة أو متأخرة:</p>
<ul>
    @foreach ($tasks as $task)
        <li>
            <strong>{{ $task->title }}</strong>
            — تاريخ الاستحقاق: {{ $task->due_date->format('Y-m-d') }}
        </li>
    @endforeach
</ul>
<p>ادخل على TaskFlow لمتابعتها.</p>