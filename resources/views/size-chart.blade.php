@extends('layouts.app')

@section('title', 'Size Chart - Seema\'s Boutique')

@section('content')
<style>
    .size-header {
        background: linear-gradient(135deg, #c2185b, #880e4f);
        color: white;
        padding: 60px 20px;
        text-align: center;
    }

    .size-header h1 {
        font-size: 36px;
        font-weight: 700;
    }

    .size-content {
        max-width: 1000px;
        margin: 60px auto;
        padding: 0 20px;
    }

    .size-table-container {
        background: white;
        border-radius: 10px;
        padding: 40px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        overflow-x: auto;
    }

    .size-table-container h2 {
        color: #c2185b;
        font-size: 24px;
        margin-bottom: 20px;
    }

    .size-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 30px;
    }

    .size-table th,
    .size-table td {
        padding: 15px;
        text-align: center;
        border: 1px solid #ddd;
    }

    .size-table th {
        background: linear-gradient(135deg, #c2185b, #880e4f);
        color: white;
        font-weight: 600;
    }

    .size-table tr:nth-child(even) {
        background: #f8f9fa;
    }

    .size-note {
        background: #fff3cd;
        padding: 20px;
        border-radius: 8px;
        margin-top: 20px;
        border-left: 4px solid #ffc107;
    }

    .size-note p {
        color: #856404;
        margin-bottom: 10px;
        line-height: 1.6;
    }

    .size-note p:last-child {
        margin-bottom: 0;
    }

    @media (max-width: 768px) {
        .size-header h1 {
            font-size: 28px;
        }

        .size-table-container {
            padding: 20px;
        }
    }
</style>

<div class="size-header">
    <h1>Size Chart</h1>
    <p>Find your perfect fit</p>
</div>

<div class="size-content">
    <div class="size-table-container">
        <h2>Indian Ethnic Wear Size Guide</h2>
        
        <table class="size-table">
            <thead>
                <tr>
                    <th>Size</th>
                    <th>Bust (inches)</th>
                    <th>Waist (inches)</th>
                    <th>Hip (inches)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><strong>M</strong></td>
                    <td>36-38</td>
                    <td>30-32</td>
                    <td>38-40</td>
                </tr>
                <tr>
                    <td><strong>L</strong></td>
                    <td>38-40</td>
                    <td>32-34</td>
                    <td>40-42</td>
                </tr>
                <tr>
                    <td><strong>XL</strong></td>
                    <td>40-42</td>
                    <td>34-36</td>
                    <td>42-44</td>
                </tr>
                <tr>
                    <td><strong>2XL</strong></td>
                    <td>42-44</td>
                    <td>36-38</td>
                    <td>44-46</td>
                </tr>
                <tr>
                    <td><strong>3XL</strong></td>
                    <td>44-46</td>
                    <td>38-40</td>
                    <td>46-48</td>
                </tr>
                <tr>
                    <td><strong>4XL</strong></td>
                    <td>46-48</td>
                    <td>40-42</td>
                    <td>48-50</td>
                </tr>
                <tr>
                    <td><strong>5XL</strong></td>
                    <td>48-50</td>
                    <td>42-44</td>
                    <td>50-52</td>
                </tr>
            </tbody>
        </table>

        <div class="size-note">
            <p><strong>📏 How to Measure:</strong></p>
            <p><strong>Bust:</strong> Measure around the fullest part of your bust</p>
            <p><strong>Waist:</strong> Measure around the narrowest part of your waist</p>
            <p><strong>Hip:</strong> Measure around the fullest part of your hips</p>
            <p style="margin-top: 15px;"><strong>Note:</strong> All measurements are in inches. If you're between sizes, we recommend choosing the larger size for a comfortable fit.</p>
        </div>
    </div>
</div>

@endsection