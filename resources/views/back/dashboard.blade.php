@extends('back.layouts.principal')
<br><br><br><br>
@section('title', 'Dashboard Admin')
@section('page_title', 'Growth Command Center')
@section('page_subtitle', 'Live commercial performance, delivery health, and engagement signals in one control surface.')

@section('content')
    <div style="display: grid; grid-template-columns: repeat(12, 1fr); gap: 20px;">

        <!-- Carte briefing principal -->
        <div style="grid-column: span 12; background: linear-gradient(180deg, #f8fcfc 0%, #ffffff 100%); border: 1px solid #dcefeb; border-radius: 28px; padding: 28px;">
            <div style="display: flex; justify-content: space-between; align-items: flex-start; gap: 20px; flex-wrap: wrap;">
                <div>
                    <div style="font-size: 13px; font-weight: 800; color: #11b1ad; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 14px;">
                        Daily Briefing
                    </div>
                    <h2 style="font-size: 26px; font-weight: 800; color: #17233b; margin-bottom: 12px;">
                        Momentum is strong today
                    </h2>
                    <p style="font-size: 16px; line-height: 1.7; color: #6e819a; max-width: 850px;">
                        Revenue is up 12.5% vs yesterday. Conversion quality improved in paid campaigns
                        and support SLA remains healthy.
                    </p>
                </div>

                <div style="display: inline-flex; align-items: center; gap: 8px; background: #ddf7e6; color: #1fa750; padding: 10px 14px; border-radius: 999px; font-size: 14px; font-weight: 800;">
                    <i class="fa-solid fa-arrow-trend-up"></i>
                    8.2% QoQ
                </div>
            </div>

            <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 18px; margin-top: 28px;">
                <div style="background: white; border: 1px solid #e6ebf2; border-radius: 20px; padding: 20px;">
                    <div style="font-size: 14px; text-transform: uppercase; letter-spacing: 1px; font-weight: 800; color: #667992; margin-bottom: 12px;">Net Revenue</div>
                    <div style="font-size: 22px; font-weight: 800; color: #162239; margin-bottom: 8px;">$48,295</div>
                    <div style="font-size: 14px; font-weight: 800; color: #16a34a;">+12.5%</div>
                </div>

                <div style="background: white; border: 1px solid #e6ebf2; border-radius: 20px; padding: 20px;">
                    <div style="font-size: 14px; text-transform: uppercase; letter-spacing: 1px; font-weight: 800; color: #667992; margin-bottom: 12px;">Active Users</div>
                    <div style="font-size: 22px; font-weight: 800; color: #162239; margin-bottom: 8px;">5,432</div>
                    <div style="font-size: 14px; font-weight: 800; color: #16a34a;">+5.8%</div>
                </div>

                <div style="background: white; border: 1px solid #e6ebf2; border-radius: 20px; padding: 20px;">
                    <div style="font-size: 14px; text-transform: uppercase; letter-spacing: 1px; font-weight: 800; color: #667992; margin-bottom: 12px;">Orders</div>
                    <div style="font-size: 22px; font-weight: 800; color: #162239; margin-bottom: 8px;">1,248</div>
                    <div style="font-size: 14px; font-weight: 800; color: #ef4444;">-3.1%</div>
                </div>

                <div style="background: white; border: 1px solid #e6ebf2; border-radius: 20px; padding: 20px;">
                    <div style="font-size: 14px; text-transform: uppercase; letter-spacing: 1px; font-weight: 800; color: #667992; margin-bottom: 12px;">Conversion</div>
                    <div style="font-size: 22px; font-weight: 800; color: #162239; margin-bottom: 8px;">3.24%</div>
                    <div style="font-size: 14px; font-weight: 800; color: #16a34a;">+1.2%</div>
                </div>
            </div>
        </div>

        <!-- Bloc gauche -->
        <div style="grid-column: span 8; background: #fff; border: 1px solid #e6ebf2; border-radius: 24px; padding: 24px;">
            <h3 style="font-size: 20px; font-weight: 800; margin-bottom: 18px; color: #17233b;">Recent Activity</h3>

            <div style="display: flex; flex-direction: column; gap: 16px;">
                <div style="padding: 16px; border: 1px solid #edf1f6; border-radius: 16px;">
                    <strong>New user registered</strong>
                    <p style="margin-top: 6px; color: #71829a;">John Smith created a new account 10 minutes ago.</p>
                </div>

                <div style="padding: 16px; border: 1px solid #edf1f6; border-radius: 16px;">
                    <strong>Payment received</strong>
                    <p style="margin-top: 6px; color: #71829a;">A payment of $320 has been received successfully.</p>
                </div>

                <div style="padding: 16px; border: 1px solid #edf1f6; border-radius: 16px;">
                    <strong>Report generated</strong>
                    <p style="margin-top: 6px; color: #71829a;">The monthly analytics report is now available.</p>
                </div>
            </div>
        </div>

        <!-- Bloc droite -->
        <div style="grid-column: span 4; background: #fff; border: 1px solid #e6ebf2; border-radius: 24px; padding: 24px;">
            <h3 style="font-size: 20px; font-weight: 800; margin-bottom: 18px; color: #17233b;">Quick Stats</h3>

            <div style="display: flex; flex-direction: column; gap: 14px;">
                <div style="padding: 16px; border-radius: 18px; background: #f8fafc;">
                    <div style="font-size: 13px; color: #71829a;">Pending Tickets</div>
                    <div style="font-size: 24px; font-weight: 800; margin-top: 6px;">18</div>
                </div>

                <div style="padding: 16px; border-radius: 18px; background: #f8fafc;">
                    <div style="font-size: 13px; color: #71829a;">New Messages</div>
                    <div style="font-size: 24px; font-weight: 800; margin-top: 6px;">42</div>
                </div>

                <div style="padding: 16px; border-radius: 18px; background: #f8fafc;">
                    <div style="font-size: 13px; color: #71829a;">Tasks Completed</div>
                    <div style="font-size: 24px; font-weight: 800; margin-top: 6px;">76%</div>
                </div>
            </div>
        </div>
    </div>

    <style>
        @media (max-width: 992px) {
            [style*="grid-column: span 8"] {
                grid-column: span 12 !important;
            }

            [style*="grid-column: span 4"] {
                grid-column: span 12 !important;
            }
        }

        @media (max-width: 768px) {
            [style*="grid-template-columns: repeat(2, 1fr)"] {
                grid-template-columns: 1fr !important;
            }
        }
    </style>
@endsection
