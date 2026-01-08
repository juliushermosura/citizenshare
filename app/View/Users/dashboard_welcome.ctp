<h1>Welcome to Citizenshare's Branch Manager Dashboard</h1>
<p>The dashboard will be used to keep you up to date on the latest help documents and FAQs regarding topics such as promoting your website, teacher onboarding, company updates and other marketing tips, tactics and strategies.</p>
<a class="various" href="/dashboard/users/getting_started">Getting Started</a>
<br /><br />
<hr />
<br />

<div class="overflowhidden">
				
				<div class="green box chart_container">
								<div class="title">Website Analytics</div>
								<script type="text/javascript" src="https://www.google.com/jsapi"></script>
								<script type="text/javascript">
										google.load("visualization", "1", {packages:["corechart"]});
										google.setOnLoadCallback(drawChart);
										function drawChart() {
												var data = google.visualization.arrayToDataTable([
														['Date', 'Unique Visitors', 'Returning Visitors', 'Page Views'],
														['11/28',  2,   2, <?php echo $this->Session->read('pageviews') ?>]
												]);
				
												var options = {
																backgroundColor: '#F4EAE2'
												};
				
												var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
				
												chart.draw(data, options);
										}
								</script>
								<div id="chart_div" style="width: 480px; height: 200px;"></div>
				
				</div>
				
				<div class="red box">
								<div class="title">
												<h2>Immediate Attention</h2>
								</div>
								
								<div class="paddingleft32 clearboth">
												<div class="floatleft width150">Payment Past Due</div>
												<div class="floatleft bold paddingbottom10">10 days</div>
								</div>
								
								<div class="paddingleft32 clearboth">
												<div class="floatleft width150">Emails Received</div>
												<div class="floatleft bold paddingbottom10">5</div>
								</div>
								
								<div class="paddingleft32 clearboth">
												<div class="floatleft width150">Teacher Request</div>
												<div class="floatleft bold paddingbottom10">10</div>
								</div>
								
								<div class="paddingleft32 clearboth">
												<div class="floatleft width150">New Blog Post</div>
												<div class="floatleft bold paddingbottom10">1</div>
								</div>
				
				</div>
				
</div>

<div class="horizontal_container">

				<div class="box2">
								<div class="title">Recent Orders</div>
								<div class="data2">18</div>
				</div>

				<div class="box2">
								<div class="title">Sales Totals</div>
								<div class="data2">18.00</div>
				</div>

				<div class="box2">
								<div class="title">This Mo.</div>
								<div class="data2">4200.00</div>
				</div>

				<div class="box2">
								<div class="title">Last Mo.</div>
								<div class="data2">100.00</div>
				</div>

				<div class="box2">
								<div class="title">2 Mos. Ago</div>
								<div class="data2">560.00</div>
				</div>

				<div class="box2">
								<div class="title">Membership Mo. Total</div>
								<div class="data2">24.00</div>
				</div>

				<div class="box2">
								<div class="title">Net Sales</div>
								<div class="data2">560.00</div>
				</div>

</div>

<div class="horizontal_container">

				<div class="box3">
								<div>Top Ref. URLs (Past 30 days)</div>
								<div class="data">How to Create A Minimum Viable Product</div>
								<p>No data yet</p>
				</div>
				
				<div class="borderleft"></div>
				
				<div class="box3">
								<div>Most Viewed Classes (Past 30 days)</div>
								<div class="data">How to Create A Minimum Viable Product</div>
								<div><a href="">more >></a></div>
				</div>
				
				<div class="borderleft"></div>
				
				<div class="box3">
								<div class="title">Total Memberships</div>
								<div class="data">0</div>
				</div>

</div>