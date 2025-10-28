**LocumKit 2.0 – Developer Guide**

**1\. Platform Overview**

Hybrid system combining:

* **Job Booking Module** – Employers post jobs, locums accept/freeze/cancel, feedback and cancellation rate tracking.  
* **Finance Module** – Invoicing, income/expenses, tax tracking, reporting.  
* **Calendar & Job Management** – Bespoke locum calendar, employer calendar, reminders, rate/distance flexibility.  
* **Feedback & CPD Tracking** – Rolling 6-month averages, disputes, and continuous professional development scores.

 

**Home:**

The home page should

·         Provide a basic outlook

·         Contain the video introduction

·         Mentions of the roles, workflows, process of each 

·         Mentions of the partners

·         Registration button leading to registration page

·         All the external links should be working

·         Registration for the newsletter

·         Blogs: should be accessible – only latest three on home page and the rest in a separate file

·         Links to the social media should be there

·         On clicking each link, the system should automatically open those links in the new tab

·         Contact buttons be working

**Accountancy:**

·         The page should display all the required information regarding the accountancy expertise of the company.

**Contact Us:**

·         The page should contain name, email and message regarding the complaints

·         Should have human verification so no bots

·         Once the complaint submitted the pop up message should notify it

·         If not been submitted the pop up message should also notify that

·         The received complaints should be received in the email of the admin

**·  Once the complaint has been resolved the email should be sent to the user**

**Registration Module**

**1\) Objectives & Scope**

* Onboard Locums and Employers with accurate, compliant profiles that drive matching, finance, and messaging.  
* Support web \+ mobile with identical validations and consistent User Experience.  
* Handle verification (email/phone and granular preferences (rate/radius per day).

**2\) Roles & Flows**

1. **Account**

   ·         Registration can be carried out as two roles i.e. locum or employer

   ·         Registration can be carried out as different professionals

   o   Ability to add new professions from admin section

   ·         Both these should be asked at the beginning of the registration

   ·         Lead to further pages after filling these

    

2. **Personal Identity** (Registration page 01\)

   ·         **Requires characters of your first name**

   ·         **Requires characters of your last name**

   ·         **Should allow the users with the same name and must not show error here**

   ·         **Email:**

   o   Should only allow verified emails to be filled into it.

   o   The email must not be repeated (should not exist before on the platform)

   o   The email address of which the account has been deleted, should then be able to be added.

   ·         **Username:**

   o   Username should have the specific characters allowed

   o   Username should not be repeated of any account already existing. Ie system should highlight

   o   Username for the accounts that has been deleted, should be able to use

   ·         **Password:**

   o   Password should be character limited

   o   Should must have the minimum specification of  covering all the uppercase, lowercase, numeric and symbols

   o   The password taken already cannot be used (by that user)

   o   Password should show the sign 'view password' that represents that it can be viewed.

   o   Password and confirm password fields should come up with this astirec which means they are mandatory to be filled

   o   Password requirement should be clearly mentioned

   ·         **Company Name:**

   o   Company Name should not be limited to characters only.

   o   There should also be no specification regarding the number of                          	characters

   ·         **Address:**

o   No limitations should be added for the field of address

o  For the town or city, only the town and city which are present   in UK should be considered.

·         **Postcode and Phone:**

o   For the postcode, only verified format for UK postcode should be allowed.

o   For home telephone, no specific limit is there. For mobile number, only UK specific format should be allowed.

**Review & Submit**        	

   	On page shift system should automatically check

·         The mandatory field is filled

·         Mandatory field accurately filled

·         Fields not on the criteria should be highlighted

·         The pop up should clearly demonstrate what is missing or wrong.

·         Keep back and next button for the user to be able to move backward while registering

     	

3. **Professional Profile** (Registration page 02\)  
   **LOCUMS –** all this is dynamic so should be editable by admin (these are used for matching)

   ·         **Experience in years (specialized)**  
   o  Provide selection option form dropdown  
   ·         **Language proficient** 	  
   o   Choose from the given options of language  
   ·         **Equipment comfortable with**  
   o   Choose from the given options  
   ·         **Specialization**  
   o   Provide options to be selected from  
   ·         **Minimum acceptance rate**  
   o   Able to fill different for each day  
   ·         **Maximum travel distance that can be covered**  
   o   Provide list of areas to be selected from  
   ·         **CET points in current cycle**  
   o   Only allow correct format (so digits and max is up to three)  
   ·         **If AOP, AOP member ship number, If not company insured with**  
   o   Only allow correct format  
   Membership related   
      **GOC number**  
   o   Allow only correct format (is in format xx-xxxxx)  
   ·         **Standard testing eye time, CL Fit or aftercare appointment**  
   ·         **Which IT systems you know**  
   o  Provide options to select from

   **EMPLOYER \-** all this is dynamic so should be editable by admin. Used for matching

   ·         **Type of store**  
   ·         Provide options to select from  
      
   ·         **Testing time offered for standard eye examination, CL fit , standard contact lens aftercare**  
   ·         **Can supervise pre reg**  
   ·         **Specialization do you require the optician to have**  
   ·         Provide options to be selected from, this should be same as the locum option for same question  
   ·         **Equipment list**  
   ·         Provide options to be selected from, this should be same as the locum option for same question  
   ·         **Language**  
   ·         Choose from the given options of languages  
   ·         **Which IT systems should locum know**

   ·         Provide options to be selected from, this should be same as the locum option for same question  
   **Review & Submit** 

On page shift system should automatically check

·         The mandatory field is filled

·         Mandatory field accurately filled

·         Fields not on the criteria should be highlighted

·         The pop up should clearly demonstrate what is missing or wrong.

·         Keep back and next button for the user to be able to move backward while registering.

           	**Admin Role:**

·         All the questions’ order, content, and options provided should be able to be edited by the admin portal

·         The addition, subtraction of the questions should be able to be controlled from admin portal.

 

**3\.	Submit** (Registration page 03\)

·         If the application has been submitted a clear pop up message notifying, “Successful submission, wait for the verification email’

·         If not submitted, clearly notify the problem

**3\.**      **Verification**

·         After the submission of the application, user and admin should get an email.

·         Once verified by the admin, the user should again receive a verification email (for employers)

·         The email should directly link it to the login page, where after adding credentials login can be made.

**Login Page:**

·         Login should be able to be accessed through two way process **username/email** or **password**

·         Provide autofill option for username

·         Provide viewing option for the password

·         **Forget Password** option should be available next to login

**Forget Password Workflow:**

Here’s the step-by-step flow from a user’s perspective:

1\.      **User clicks “Forget Password”** on the login page.

2\.      **User enters registered email** (the one used during signup).

3\.      System checks if this email exists in the database:

o	If yes → A **reset link** is sent to their email.

o	If no → Show a polite error message: *“This email is not registered with us.”*

4\.      User opens their email and clicks the reset link.

5\.      The link takes them to a **secure Reset Password page**.

6\.      User enters a **new password** and confirms it.

7\.      System checks password rules (length, strength, etc.).

8\.      If valid → Password is updated, and the user gets a success message.

9\.      User can now log in with the new password.

 

**2\. Job Booking Module**

**2.1 Employer Workflow**

* Post a job (reference, date, rate, special requirements, present rate increase)

a **A) Where to Start**

1. **Login** to your employer account.  
2. On your dashboard, look for the button: **“Post a New Job”** (usually top right or in the job management module). Or can post job from the dashboard calendar

 

**B) Job Posting Form – Field by Field**

When you click *Post a New Job*, you will see a form. Fill it out step by step:

1. **Job Reference**  
   * A short name or code you choose to identify the job (e.g., *OPT-JAN25-001*).  
   * This is visible to you and the locum, so make it meaningful.  
2. **Date & Time**  
   * Select the **date** you need the locum – date should be UK format everywhere  
   * Add **start and end time** (e.g., 9:00 – 17:30).  
   * If you need this role for multiple days, you can add additional dates later.  
3. **Location / Store**  
   * Pick from your registered stores  
   * Store details include address, contact number, and any access instructions.  
4. **Rate Offered**  
   * Enter the amount you are willing to pay (e.g., £250 per day).  
   * Note: This is the first rate locums will see when invited.  
5. **Preset Rate Increase (Optional)**  
   * If you want to automatically increase the rate if nobody accepts within a set time, you can add rules here.  
   * Example: *Increase by £25 if not accepted by 12:00 this date*  
   * The system will automatically notify locums when the rate changes

Duration dropdown start time with end time .. like 9-12 etc

Time 3:00pm

![][image1]

6. **Special Requirements (Optional)**  
   * Tick or type any extra requirements for the job. Examples:  
     * Must speak Urdu  
     * Must be experienced with OCT scans  
     * Must cover contact lens fitting  
   * If you tick a **Required** skill/language, only locums who meet that will see your job. Matching concept  
7. **Number of Locums Needed**  
   * If you need more than one locum for the same date/time (e.g., two locums in a large store), enter the number here.  
   * The job will stay open until that many locums accept.  
8. **Special Instructions**  
   * A free-text box for any extra notes (e.g., *parking available at rear, bring your own trial frame*).

**C) After Posting**

1. Once you hit **Submit**, the system does three things instantly:  
   * Saves your job in your **Manage Jobs** list as *Open*.  
   * Shows list of locums it would invite – here those blocked would not show even if matching  
   * Then can select to send to all or pick and mix  
   * Sends **invitations** to matched locums (based on skills, languages, availability, and rates).  
   * Sends you a confirmation email with your job details.  
2. On your **dashboard/home page**, you’ll see the job appear in your quick-view box for the current month.  
3. Locums who match your job will see an **Invite Card** in their dashboard and mobile pop up. Private locums you add will also receive an email invite.

 

**D) What You Will See After Posting**

* **Employer Dashboard**: Job appears under *Open Jobs*. Status shows *Waiting for Locums*.  
* **Locum Dashboard**: Matched locums see it under *Invited*. Private locums get email only.  
* **Admin Dashboard**: Job is logged, stats increment.

 

**E) Emails Triggered**

* **Employer (you)**: Confirmation email with job reference, date/time, and link to manage job.  
* **Locums (matched)**: Invitation email with rate, store, date, and Accept/Freeze/Negotiate buttons.  
* **Admin**: Internal notification for stats/logging.

In admin panel , there is no live notification implemented . Admin can only notify via email

 

**F) Key Rules for Posting**

* If you add **Required languages/skills**, only those locums will match.  
* If a locum is already **booked/unavailable**, they won’t be invited.  
* If your rate is **below** the locum’s minimum, they won’t appear unless rate later increases.  
* Preset rate increases keep the job alive and improve chances of filling.  
* You can **edit** the job after posting; locum matches refresh automatically.

When a job is posted and accepted by Locum , it cannot be updated . This is how a system works , for new modifications ,we can duplicate with new changings . 

Before acceptance 

* If you **duplicate** a job, you can quickly repost with new dates or rates.

1 **System Match (Automatic Invitations)**

When you post a job, the system automatically looks for locums who match your requirements. This is called **System Match**.

**How Matching Works**

1. This matching is based on questions asked in registration to both locum and employer (dynamic questions)  
   * Availability (locum must not be booked/unavailable).  
   * Required skills (e.g., *Basic Eye Test*).  
   * Required languages (e.g., *Urdu*).  
   * Minimum rate (your offered rate must be ≥ locum’s minimum).  
   * Distance/travel radius.  
2. **Ranking**: System allows for filter of locums with:  
   * Strong feedback scores.  
   * CPD points (higher \= higher ranking).  
   * Lower cancellation rate.

**Example: Urdu Requirement**

* If you mark “Must speak Urdu” as required → only locums who ticked Urdu in registration appear.

**What Happens Next**

Each locum can choose from four clear options when receiving an invitation:

1\. Accept – The locum commits to the job immediately. The job moves to Accepted on both sides, the employer is notified, the slot closes (unless multiple locums are required), and the locum’s calendar is updated. This creates a binding agreement.

The job will automatically get removed from other locums’ dashboard, hence they can accept it.

2\. Freeze – The locum can temporarily reserve the job for 15–20 minutes if the job is more than 48 hours away. This ensures they don’t lose the opportunity while busy with a patient. During the freeze period, no one else can accept or action the job. The freeze must convert to an acceptance before expiry, or the job reopens to others. Abuse of freezes (e.g., repeated freezes without acceptance) will lead to suspension of the freeze option. Private locums cannot use this option.

If not accepted in time, then that locum can no longer freeze and job opens again for all.

After Freeze time ends, locum should be able to select accept or negotiate.

3\. Negotiate – The locum can send a counter-offer (e.g., different rate or adjusted hours). This puts the job into Negotiation Pending on both dashboards. The employer can accept, decline, or counter back. The loop continues until either accepted or declined. The employer might have multiple negotiations tab so his option is accept, counter or decline.  

4\. Ignore – The locum does nothing. The job remains visible in their dashboard until it expires or is filled, but they take no action. Employers are not notified of ignores, but the system logs non-responses for analytics.

All four actions trigger corresponding dashboard updates, notifications, and system logs so employers, locums, and admins always have a consistent view of the job status.

**B) Private Freelancer Invitations**

**Sometimes you want to invite a locum who is not a LocumKit member.**

**How to Add**

1. In your job post screen (or Manage Jobs), click “Add Private Freelancer”.  
2. Enter:  
   * Name  
   * Email address (for invitations)  
   * Phone number (optional)  
3. Click Invite.

**What Happens Next**

* The private locum gets an invitation email only (not shown in system search).  
* They can only Accept the job (they cannot Freeze or Negotiate).  
* They should be able to accept the job through the email  
* Once accepted, the job appears in your dashboard like any other confirmed job.

 

**C) Employer Dashboard Views**

* Open Jobs: Shows which locums have been invited.  
* Waiting: Displays pending responses.  
* Confirmed: Moves here once a locum accepts.  
* Private Invites: Clearly tagged to separate them from member locums.

 

**D) Notifications Triggered**

1. **Employer**:  
   * Confirmation that invitations have been sent.  
   * Updates in Manage Jobs showing invited locums.  
2. **Locum (System Match)**:  
   * Email \+ app notification with job details.  
   * Dashboard card under *Invited Jobs*.  
3. **Locum (Private)**:  
   * Email with Accept button.  
   * No Freeze/Negotiate options.  
4. **Admin**:  
   * Logging of invites, accepted, cancellation for audit.

 

**E) Rules & Restrictions**

* You cannot invite the same locum twice for one job  
* If a locum is already booked, they won’t receive an invite.  
* Private locums can be added by multiple employers, but if that locum later registers as a member, the system merges records.  
* Locums already blocked by you will not appear in System Match but on the block list which can be viewed and edited.

 

**2.2 Locum Workflow**

* Receive job invitations (matched based on profile).- both emails and mobile pop ups  
* Options: **Accept** (binding contract), **Freeze** (15–20 mins), or ignore.  
* Manage calendar availability, rates, and private jobs.  
* Provide employer feedback after each completed job.

## **1\) Accept Job**

### **Flow**

1\.      Locum clicks **Accept** on a job (from dashboard, calendar, or job invite).

2\.      Job is marked as **Accepted** → legally binding agreement.

3\.      Employer notified immediately.

4\.      Job slot is closed to other locums (unless multiple locums required).

### **System Updates**

·         **Locum Dashboard**: Job moves to *Accepted Jobs* panel. Status \= Accepted.

·         **Locum Calendar**: Date is blocked with job details (store, time, rate).

·         **Employer Dashboard**: Job moves to *Confirmed/Upcoming Jobs*.

·         **Admin Stats**: Increment counters for “Accepted Jobs”.

### **Notifications**

·         **Locum**: Acceptance confirmation email \+ in-app popup.

·         **Employer**: Acceptance email (with locum profile details).

·         **Admin**: Acceptance logged in reporting dashboard.

 

## **2\) Cancel Job**

### **Flow**

·         **By Locum**:

1\.      Locum clicks **Cancel Job**.

2\.      Employer and Admin notified.

3\.      Cancellation % (6‑mo rolling) updates for locum.

4\.      Employer free to relist the job.

·         **By Employer**:

1\.      Employer cancels confirmed job.

2\.      Locum and Admin notified.

3\.      Employer’s cancellation % updates.

### **System Updates**

·         **Locum Dashboard**: Job moves to *Cancelled Jobs*.

·         **Employer Dashboard**: Job moves to *Cancelled* with reason.

·         **Calendar**: Slot unblocks.

·         **Admin Stats**: Cancellation counters update.

### **Notifications**

·         **Locum Cancel → Employer**: Employer receives “Cancelled by Locum” email \+ option to relist job.

·         **Employer Cancel → Locum**: Locum receives “Job Cancelled by Employer” email.

·         **Admin**: Cancellation report with who initiated.

 

## **3\) Negotiate Job**

### **Flow**

1\.      Locum clicks **Negotiate** on invite.

2\.      Options to counter **rate**, **hours**, or **requirements**.

3\.      Employer notified with proposed changes.

4\.      Employer may **Accept**, **Reject**, or **Counter‑Negotiate**.

### **System Updates**

·         **Locum Dashboard**: Job moves to *Pending Negotiation* with status.

·         **Employer Dashboard**: Job shows *Negotiation Pending*.

·         **Admin Stats**: Negotiation event logged.

### **Notifications**

·         **Employer**: Negotiation request email \+ dashboard alert.

·         **Locum**: Status updates when employer responds.

·         **Admin**: Negotiation count increments in reporting.

 

## **4\) Freeze Job**

### **Flow**

1\.      Locum clicks **Freeze** (only available \>48h before job).

2\.      Job slot reserved exclusively for 15–20 min.

3\.      Locum can then Accept or Release.

### **System Updates**

·         **Locum Dashboard**: Job moves to *Frozen Jobs* with countdown timer.

·         **Employer Dashboard**: Job marked as “Frozen by Locum \[Name\]”.

·         **Calendar**: Not yet blocked (only upon Acceptance).

·         **Admin Stats**: Freeze event recorded.

### **Notifications**

·         **Locum**: Freeze confirmation popup \+ reminder before expiry.

·         **Employer**: “Job Frozen” email (locum identity may be hidden until acceptance).

·         **Admin**: Freeze log \+ abuse monitoring (90% freeze/no accept rule).

 

## **5\) Dashboard Overview (Locum)**

·         **Job Invites Tab**: Pending jobs (Accept, Freeze, Negotiate, Ignore).

·         **Accepted Jobs Tab**: Confirmed work.

·         **Frozen Jobs Tab**: Active freezes with timers.

·         **Cancelled Jobs Tab**: Historical cancellations.

·         **Negotiations Tab**: Jobs under negotiation.

 

## **6\) Dashboard Overview (Employer)**

·         **Open Jobs**: Posted jobs not yet filled.

·         **Pending Responses**: Awaiting locum action (freeze/negotiation).

·         **Confirmed Jobs**: Accepted by locum(s).

·         **Cancelled Jobs**: Cancelled by employer or locum.

·         **Negotiations**: Active counter‑offers.

 

## **7\) Email/Notification Templates (per action) – note we say email but it would also be mobile pop ups**

·         **Acceptance**: “Job Accepted – \[Locum Name\] confirmed \[Job ID\].”

·         **Cancellation**: “Job Cancelled by \[Party\].” Includes relist option.

·         **Negotiation**: “Locum \[Name\] proposes new rate \[X\].” Action required.

·         **Freeze**: “Job \[Job ID\] frozen by \[Locum Name\].” Timer included.

 

## **8\) Admin Reporting**

·         **Real‑time Stats**: Acceptances, Cancellations (by party), Negotiations, Freezes.

·         **Audit Logs**: Every action stored with timestamp, actor, job ID.

·         **Dispute Handling**: 48‑hour window if unfair feedback tied to job outcome.

 

## **9\) Developer Rules Recap**

·         Every **action** must update:

o    **Dashboard views** (locum \+ employer).

o    **Calendar entries** (block/unblock).

o    **Emails/notifications** (all parties \+ admin).

o    **Stats tracking** (accept/cancel/freeze/negotiation counts).

·         System must enforce rules:

o    Freeze disabled if job \<48h away.

o    Cancels/accepts update rolling 6‑mo metrics.

o    Negotiation loop must always resolve to **Accept** or **Cancel**.

 

**2.3 Feedback Rules**

 

**Feedback Tracking**

**After each job both locum and employer are sent emails to leave feedback for each other**

* **Locums receive feedback** from employers after each completed job (clinical ability, professionalism, teamwork, punctuality, overall satisfaction).  
* **Employers receive feedback** from locums on professionalism, accuracy of job adverts, working environment, diary management, and overall satisfaction.  
* **Scoring** is via 1–5 stars.  
* **Rolling average**: Only the last 6 months of feedback count; older scores drop off.  
* **Visibility**: Employers see a locum’s average before inviting; locums see an employer’s average before accepting.  
* **Disputes**: 48-hour window to raise disputes; feedback hidden until admin resolves.

**Cancellation Rate Tracking**

* Every cancellation is logged and attributed (employer or locum).  
* **Formula**: cancellations ÷ total accepted jobs (last 6 months).  
* Displayed as a percentage on profiles and invites.  
* **Impact**: High cancellation rates reduce trust and lower ranking in system matches.  
* **Private jobs**: Off-platform/private cancellations do not affect cancellation rate.  
* **Dashboards**: Stats update in real time.

**Examples**

* Locum accepts 20 jobs, cancels 2 → 10% rate.  
* Employer posts 15 jobs, cancels 5 → 33% rate.

 

**1** There is a 48-hour dispute window before feedback becomes visible. This means once feedback is submitted, it is placed in a pending state for two full days. During this time the recipient (either locum or employer) can review the comments and choose to contest them if they believe the feedback is unfair or inaccurate. If a dispute is raised, the feedback remains hidden from all public profiles until the admin team investigates and makes a final decision. If no dispute is raised within 48 hours, the feedback is automatically published to the profile and included in the rolling 6-month average. If dispute is raised then admin can approve or reject feedback.

**2.4 Cancellation Rules**

* Cancellation rates tracked separately for employers and locums.  
* Only applies to jobs booked **via LocumKit**, not private jobs.  
* Calculated as % of accepted jobs cancelled within last 6 months.  
* When employer or locum cancel then they have to give a reason for it  
* Displayed alongside profiles/job invites.

**2.5 Freeze Rules**

* Locum can freeze job for 15–20 mins.  
* Not available for jobs \<48h away.  
* Abuse prevention: if \>90% freezes without acceptance, feature suspended – done manually by admin hence admin needs this report

 

 

**3\. Notifications & Emails**

**3.1 Email Templates**

* **Invitation email**  
* **Acceptance email**  
* **Cancellation email** (by employer / locum)  
* **Freeze email** \+ 5-min release notification  
* **Feedback email**

Emails should work for Locum:

·  When a job matching their requirement comes through

·  When a job rate increases

·  When a job is back on the scene (i.e. someone froze but not accepted)

·  When job accepted and confirmed \- so booking confirmation 

·  Day before job reminder

·  On the day at 10pm asking have you arrived

·  On the day at 2pm asking for lunch and other expenses

·  Day after job (if website booked), asking for feedback

·  Reminder after one week if feedback not left

·  When the locums feedback comes through then email to show what feedback came

 

        Emails should work for Employer:

·  When it is posted

·  When rate increase has been actioned

·  When someone accepts it so booking confirmation 

·  Day before job reminder

·  Day after job (if website booked), asking for feedback

·  Reminder after one week if feedback not left

·  When the locums feedback comes through then email to show what feedback came

 

**3.2 Reminders**

* LocumKit detects all bookings (site \+ private).  
* 24h reminder before job (email \+ push).  
* Reminder on the day of the job  
* Weekly Sunday summary of upcoming jobs.

 

**4\. Calendar & Job Management**

**4.1 Locum Calendar**

* Colour coding: booked, free, unavailable.  
  The colour coding should be depicted as the following colours for the following actions

  ·         Days worked \= Pale orange  
  ·         Current Date \= Blue  
  ·         Booked \= Orange  
  ·         Available \= Green  
  ·         Not available \= Red

**Current month bookings:**

**Under live jobs**

·         This includes the jobs that have not been completed but have been accepted. Once the job will be finished it will automatically move to the job management bar.

·         List of the jobs for the current month for the jobs through Locumkit.

·         Each job should depict the date, employer, status etc

 

**Under private jobs**

List of the jobs for the private employers

Each job should depict the date, employer, status etc

 

**Editable rate/travel distance per day**

1 When you post a job, the system automatically looks for locums who match your requirements. This is called **System Match**.

**Editable Rate/Travel Distance per Day**

Locums can fine-tune their profile settings on a daily basis to better reflect their circumstances. Their matching remains the same but for that day it is different

* **Rate per day**: A locum can set a general minimum daily/hourly rate in their registration. But they can also override it for a specific date (for example, increasing their rate on a weekend, or lowering it midweek if they want to increase chances of work). If an employer posts a job below the locum’s set rate, the locum will not appear in search unless the rate increases later.  
* **Travel distance per day**: Similarly, locums can normally set a maximum travel radius (e.g., 15 miles). But they can adjust this per day – for example, extending it to 25 miles on a quiet day or reducing it to 5 miles when they are busy locally.  
* **System effect**: When matching, the system checks the locum’s rate and travel preferences for the exact date of the job posting, not just their default profile. This ensures more accurate matching and avoids irrelevant invites.  
* **Employer view**: Employers will only see and be able to invite locums whose date-specific settings allow them to match. This keeps invites relevant and reduces decline rates.

 

* Add “private jobs” (agency/direct work).

Here locum adds job booked not on Locumkit platform to benefit from the reminders and financial module

* Sync with finance module (auto record income)

The platform links job outcomes to the Finance module so you don’t need to re‑enter earnings manually.

**When income is auto‑created**

* **Arrival confirmation (recommended flow):** On the job day, the locum gets an “Arrived?” prompt. Arrival time is 10am on the day but configurable by admin. When they tap Yes, the system creates an Income record linked to the job/contract as the system already knows the day and rate (regardless of if private or Locumkit job)

**What gets saved to the Income record**

* Job reference, store, date, start/end time.  
* Rate/unit actually contracted (includes any accepted **rate increase** or final negotiated rate).  
* Employer (supplier) details.  
* Location (for reporting).  
* Tax/VAT flags if applicable (company vs sole trader profiles).

**Dashboards & reports**

* **Locum Finance Dashboard:** P\&L, cashflow, job profitability, debtors  
* **Employer Finance:** View obligations and exported summaries.  
* **Real‑time updates:** As soon as income is created or banked, charts and totals refresh.

**Invoicing linkage**

* For site‑booked jobs, the income appears in Invoicing ▸ Uninvoiced. Locum can Send Invoice in 1–2 clicks. Debtor ageing updates automatically.

**Edge cases & rules**

* **Cancellations:** No income is created if the job is cancelled. If income was pre‑created by mistake, cancelling the job **reverses** or flags it for review.  
* **Rate changes:** If a preset rate increase triggered **before acceptance** or a negotiation was approved, the income uses the **final contract rate**.  
* **Partial day / time edits:** If the accepted hours are edited (by mutual agreement), the income record updates accordingly.  
* **Manual override:** Locum can edit or delete the income entry (keeps audit history) if something’s wrong.

 

**4.2 Employer Calendar**

* Displays all confirmed bookings, cancelled  
* Colour coding: booked, free, unavailable.  
  The colour coding should be depicted as the following colours for the following actions

  ·         Days worked \= Pale orange  
  ·         Current Date \= Blue  
  ·         Booked \= Orange  
  ·         Available \= Green

       	On clicking the specific date for the job booking the, system will take it to the job booking module where the new job can be posted as described above.

**Current month bookings:**

·         **Under live jobs**

This includes the jobs that have not been completed but have been accepted. Once the job will be finished it will automatically move to the job management bar.

List of the jobs for the current month for the locums on the Locumkit.

Each job should depict the date, job title, locum, status etc

·         **Under private jobs**

List of the jobs for the private employers

Each job should depict the date, job title, private locum name, status etc

 

* **Supports private freelancers.**  
  Private freelancers can be booked by the same method of job posting as described  above.  
* **Duplicate/edit job postings.**

The same jobs can be duplicated by the duplicate feature in job management

 

**Sync with finance module (auto record income)**

The platform links job outcomes to the Finance module so you don’t need to re‑enter earnings manually.

**When income is auto‑created**

* **Arrival confirmation (recommended flow):** On the job day, the employer gets a prompt saying, ‘has the locum arrived’. Arrival time is 10am on the day but configurable by admin. When they tap Yes, the system creates an Income record linked to the job/contract as the system already knows the day and rate (regardless of if private or Locumkit job)

**What gets saved to the Income record**

* Job reference, Job Id, locum ID, date, start/end time.  
* Rate/unit actually contracted (includes any accepted **rate increase** or final negotiated rate).  
* Locum details.  
* Location (for reporting).  
* Tax/VAT flags if applicable (company vs sole trader profiles).

**Dashboards & reports**

* **Expenditure on locum:** the chart gets updated showing the amount, cash flow over the period of time. This is depicted in the form of bar chart.  
* **No of locums recruited:** This shows the list of the locums recruited in each month.  
* **Real‑time updates:** As soon as income is created or banked, charts and totals refresh.

**Edge cases & rules**

* **Cancellations:** No income is created if the job is cancelled. If income was pre‑created by mistake, cancelling the job **reverses** or flags it for review.  
* **Rate changes:** If a preset rate increase triggered **before acceptance** or a negotiation was approved, the income uses the **final contract rate**.  
* **Partial day / time edits:** If the accepted hours are edited (by mutual agreement), the income record updates accordingly.  
* **Manual override:** Locum can edit or delete the income entry (keeps audit history) if something’s wrong.

 

 

**4.3 Job Management Views**

* **Accepted** – Shows the jobs that have been accepted, yet not completed  
* **Completed** – Shows the jobs that have been completed  
* **Waiting** – Shows the job on which the reply from locum is waiting  
* **Cancelled** (with initiator recorded) – The jobs that were posted but were cancelled  
* **Expired** – Shows the job that got expired i.e. was posted but was not completed and the day passed  
* All  
* The tables should be categorised as displaying job title, job date, date posted, job rate, job status, Locum names, action  
* The action column should display buttons of view, edit, deleted or duplicate job.  
* Once the job has been accepted or day has passed it should not be able to be edited  
* The duplicate button should lead to another job posting, with the same specifications as of the previous job, with the choice of editing the fields, and resending the invite to the locums  
* Blocked locums can also be managed form here

**Block Locums Feature**

Locums are blocked generally post a job, so when asking for feedback, the employer has a chance to block them then or when they get told a locum has cancelled

## **Purpose**

The **Block Locums** feature allows employers to stop certain locums from seeing or applying to their future jobs. This protects employers from repeated cancellations, poor conduct, or mismatched expectations, and helps improve the quality of bookings on the platform.

 

## **2\. When Blocking Can Happen**

Employers can block a locum in two main situations:

1\.      **After a Job is Completed** – When giving feedback, the employer has an option:

o	Rate the locum.

o	Leave remarks.

o	**Choose to block the locum** from future jobs.

2\.      **When a Locum Cancels a Job** – Employers may receive a notification that a locum has cancelled. At this stage, the system should provide an **option to block** that locum.

 

## **3\. Workflow (Step by Step)**

## **Scenario 1: Employer leaves feedback after a job**

1\.      Employer finishes the feedback form.

2\.      System shows a **“Block this Locum”** checkbox.

3\.      If employer ticks it → Confirm message appears:

o    *“Are you sure you want to block this locum from seeing your future jobs?”*

4\.      If confirmed → The system marks that locum as “blocked” for this employer.

5\.      Locum will no longer see or apply to jobs from this employer.

 

## **Scenario 2: Employer reacts to a job cancellation**

1\.      Employer gets a cancellation notification (e.g., “Locum X has cancelled your booking”).

2\.      Alongside the notification, system shows option:

o    *“Would you like to block this locum from future jobs?”*

3\.      If employer confirms → The system blocks the locum for this employer.

4\.      Employer is shown a success message:

o    *“Locum has been blocked. They will not be able to apply to your future jobs.”*

 

## **4\. System Behaviour After Blocking**

·         **Job Visibility:** Blocked locums should not see jobs posted by that employer.

·         **Applications:** If blocked, they cannot apply even if they see a shared link.

·         **Records:** Blocking is only between one employer and one locum (not platform-wide).

·         **Reversing a Block:** Employer should have the option to “Unblock” a locum later in case they want to work together again.

 

## **5\. Admin Oversight (Back Office)**

·         Admins should have a report called **“Blocked Locums Report”** (already part of your requirements).

·         Report should show:

o    Employer ID & name.

o    Locum ID & name.

o    Date of block.

o    Reason (if employer provided one).

·         Admins should be able to manually unblock if required.

Can you please provide the link of admin dashboard or ss where these reports are ? I couldn't find anything related to reporting Section.

**Manage Blocked Locums**

**1\. Purpose**

The **Manage Blocked Locums** section allows employers to view, track, and control the locums they have blocked. It gives employers more control, prevents mistakes, and ensures transparency in their hiring activity.

 

## **2\. Placement in Admin Portal**

·         Module: **Job Management**

·         Subsection: **Manage Blocked Locums**

 

## **3\. Workflow**

## **A. Employer Side (Platform Users)**

1\.      **Employer blocks a locum** (via feedback or cancellation flow).

2\.      The block relationship (Employer ↔ Locum) is saved in the system.

3\.      Employer can later go to **Job Management → Manage Blocked Locums**.

4\.      The page shows:

o    List of all blocked locums.

o    Each entry displays:

§  Locum ID

§  Full Name

§  Profession (Optometrist, Pharmacist, etc.)

§  Date Blocked

§  Reason (optional, if employer gave one).

5\.      Employers can:

o    **Search** by locum name or ID.

o    **Filter** by profession or block date.

o    **Unblock** a locum (confirmation required).

 

## **B. Admin Side (Portal Back Office)**

·         Admins see an aggregated **Blocked Locums Report** across the entire platform.

·         Admins can:

o    Search by employer or locum.

o    See reasons and dates.

o    Manually unblock if necessary.

o    Export report (CSV/Excel).

·         Admins can also track patterns (e.g., if one employer blocks too many locums, or one locum is blocked repeatedly).

 

## **4\. Key Features in “Manage Blocked Locums” Section**

## **4.1 List View**

Columns:

·         Employer Name

·         Employer ID

·         Locum Name

·         Locum ID

·         Profession / Category

·         Block Date

·         Reason (if given)

·         Status (Blocked / Unblocked)

·         Actions (Unblock, View History)

## **4.2 Actions**

·         **Unblock Locum:**

o    Show confirmation: *“Are you sure you want to unblock this locum? They will again be able to apply to your jobs.”*

o    After confirmation, status changes to “Unblocked”.

o    Record the unblock date and who performed it (Employer/Admin).

·         **View History:**

o    Timeline showing: Block date, unblock date, by whom, reason.

 

## **5\. System Rules**

·         Blocking is **one-to-one** (an employer blocks a locum, not system-wide).

·         If locum is blocked:

o    They cannot see employer’s future job postings.

o    They cannot apply to the employer’s jobs.

·         If unblocked:

o    They regain normal access to employer’s jobs.

·         Employers can re-block the same locum later.

## **6\. User Messaging**

·         **Employer Block Action:**

o    Before blocking → *“Do you want to block this locum from all your future jobs?”*

o    After blocking → *“Locum has been blocked successfully.”*

·         **Employer Unblock Action:**

o    Before unblocking → *“Do you want to unblock this locum? They will again be able to apply to your jobs.”*

o    After unblocking → *“Locum has been unblocked.”*

·         **Locum View:**

o    Locums are **not notified directly**. They simply stop seeing the employer’s jobs in their listings.

 

 

 

**5\. Finance Module**

**5.1 Dashboard**

1 The Finance module gives locums a clear overview of their business performance. Data from accepted and confirmed jobs flows automatically into these views.

**Profit & Loss (P\&L) Snapshot**

* **Shows:** Total income minus expenses over a period (month, quarter, year).  
* **Detail:** Breakdown by income category (website jobs, private jobs, other) and expense categories (travel, subscriptions, insurance, supplies).  
* **Updates:** Real-time refresh when new income/expenses are recorded.

**Cashflow**

* **Shows:** Timing of money in and out (not just totals).  
* **Purpose:** Helps locums see if they will have enough cash to cover upcoming bills.  
* **Detail:** Upcoming invoices due, expected receipts, recurring expenses (like indemnity insurance).  
* **Visualisation:** Bar or line graph by week/month.  
* Is updated by locum by ticking cash on the transaction if money has come in and out of bank

**Job Profitability**

* **Shows:** Income minus direct expenses linked to each job.  
* **Purpose:** Identify which jobs, employers, or store types are most profitable.  
* **Detail:** Compare rates offered vs travel time/expenses. Highlight jobs that look good on paper but net low after costs.  
* **Uses:** Employers can also see which stores/branches generate the most value.

**Tax Liability (Real-time Estimate)**

* **Shows:** Running estimate of how much tax is owed (self-assessment, corporation tax if company).  
* **Purpose:** Avoid surprises at tax deadlines.  
* **Detail:** System applies standard UK thresholds (personal allowance, tax bands, NI). Updates live as income and expenses are added.  
  Done by admin config where I can update them – the tax rates this is. Logic of calculation is shared  
* **Reminders:** System flags upcoming due dates for payments.

 

**5.2 Invoicing**

* Manual invoice option.  
  * Because system knows if day worked or not it would be able to calculate if invoice is due or not  
  * Some suppliers do not need invoice so will assume invoiced on day of job  
* Templates & reminders for unpaid invoices.  
* Debtor aging report.

**5.3 Income**

* Auto-recorded from jobs (with locum arrival confirmation).  
* Manual entry possible.  
* Breakdown by area, store, employer.

**5.4 Expenses**

* Manual input or automated (e.g. travel mileage calc @ £0.45).  
* Snap & upload receipts.  
* Reminders for common expenses (subscriptions, indemnity, travel).

**5.5 Tax**

* Real-time tax liability estimate.  
* HMRC filing integration (Self-Assessment / Corp Tax).

**5.6 CPD Tracking**

* Locum submits CPD points every 3 months (with evidence).  
* Employers can view scores on their job posting screen

**5.7 Weekly Report**

* Weekly Report should show **income** and **number of jobs** record per week  
* Each report should depict daily income and number of jobs done (under the name of the day) for a particular week.  
* The roll down should correspondingly show the record of the previous week  
* This can be filtered with respect to month under a particular year

**5.8 Income by area**

* Income by area depicts a yearly report of the income made in the specific area  
* Pie chart will display the areas in which the locum has worked and income has been made  
* From the highest to lowest percentage  
* Specify under what lowest percentage the chart will put all the areas in a single segment (5 percent)  
   

**5.8 Income by category**

* Income by category depicts a yearly report of the income made in the specific category (lunch, travel etc)  
* Pie chart will display the categories in which the locum has worked and income has been made  
* From the highest to lowest percentage  
* Specify under what lowest percentage the chart will put all the categories in a single segment (5 percent)  
* The list below should show the jobs in the order of highest earned to the lowest earned.  
* The jobs should be categorised tran no, job no, date, amount, location, bank, bank date etc.  
* Drop down should be used to shift the same from yearly to monthly basis, hence changing all the values to the monthly basis.  
* Another chart (line chart) should depict the paid or pending amounts of different months over the period of a year.  
* These paid or pending lines within a single chart will depict the corresponding values for both respectively  
* The system should be able to generate the paid or pending values charts for both income and bonus  
* The above should be accessible by applying filter  
   

**5.8 Income by Supplier**

* Income by supplier depicts a yearly report of the income made by the specific supplier  
* Pie chart will display the suppliers with which the locum has worked and income has been made  
* From the highest to lowest percentage  
* Specify under what lowest percentage the chart will put all the suppliers  in a single segment (5 percent)  
* The list below should show the jobs in the order of highest earned to the lowest earned.  
* The jobs should be categorised tran no, job no, date, amount, location, bank, bank date etc.  
* Drop down should be used to shift the same from yearly to monthly basis, hence changing all the values to the monthly basis.  
* Another chart (line chart) should depict the paid or pending amounts of different months over the period of a year.  
* These paid or pending lines within a single chart will depict the corresponding values for both respectively  
* The system should be able to generate the paid or pending values charts for different suppliers  
* The above should be accessible by applying filter

**5.8 Expense by category**

* Expense by category depicts a yearly report of the income made in the specific category (lunch, travel etc)  
* Pie chart will display the categories in which the locum has worked and income has been made  
* From the highest to lowest percentage  
* Specify under what lowest percentage the chart will put all the category in a single segment (5 percent)  
* The list below should show the jobs in the order of highest earned to the lowest earned.  
* The jobs should be categorised tran no, job no, date, amount, location, bank, bank date etc.  
* Drop down should be used to shift the same from yearly to monthly basis, hence changing all the values to the monthly basis.  
* Another chart (line chart) should depict the paid or pending amounts of different months over the period of a year.  
* These paid or pending lines within a single chart will depict the corresponding values for both respectively  
* The system should be able to generate the paid or pending values charts for all categories  
* The above should be accessible by applying filters

 

**1\. Admin Portal**

The Admin Portal is the central management system for the Locum platform (covering healthcare and optometry). It enables administrators to **monitor, manage, configure, and report** on all activities, including users, jobs, finance, disputes, categories, and content.

 

### **3.1 Dashboard**

·         **Charts:**

o    Line Chart: Users registered (Locum vs Employer), by month (current year).

o    Pie Chart: Breakdown of Users, Jobs, Income (for current year).

·         **Quick Stats:** Counters for Bookings, Cancellations, Freezes, Disputes, New Joiners, Leavers, Private Jobs, Private Locums.

·         **Quick Links (Sub-modules):**

o    Pages | Users | Jobs | Categories | Packages | Finance | Feedback | Configurations

 

### **3.2 Pages Management**

·         **Features:**

o    Page List (All static & dynamic pages, with edit controls).- so can manage all static pages for home page

o    Create Page

o    Blog Management – can write blogs, edit like wordpress

 

### **3.3 User Management**

·         **User Types:** Locum, Employer, Admin

·         **Features:**

o    List View with filters: Username, Email, Status, Registration Date.

o    Table Columns: ID, Username, First Name, Last Name, Email, Status, Edit/Delete.

o    User Status Toggle: Active/Inactive (affects access to platform).

o    Editable fields by Admin: Package assignment, Status.

 

### **3.4 Roles & Permissions**

·         **Features:**

o    Role List (Admin, Moderator, Finance Manager, etc.).

o    Create Role

o    Ensure every module has role-based access.

 

### **3.6 Categories**

·         **Features:**

o    Category List (Healthcare, Optometry, Pharmacy, etc.).

o    Create/Edit Category.

o    Categories selectable by users during registration.

 

### **3.7 Registration Questions**

·         **Features:**

o	Question Bank linked to Categories & User Types.

o	Create/Edit/Delete questions.

o	Define Input Type (text, dropdown, checkbox).

o	Dependency Mapping: Some questions conditional on others.

 

### **3.8 Payments & Finance**

·         **Features:**

o    Payment List: User Name, Email, Amount, Type (Free, Paid, Subscription), Status.

o    Export Finance Data (CSV/Excel).

o    Tax Rate Management: Admin can update VAT/Service Tax percentages.

o    Alerts for failed/cancelled payments.

 

### **3.9 Feedback Questions & User Feedback**

·         **Feedback Questions:**

o    Manage pool of questions for feedback forms.

o    Create/Edit/Delete.

·         **User Feedback:**

o    Display feedback with rating \+ remarks.

o    Filters: Locum Feedback vs Employer Feedback.

o    Export feedback data.

 

 

### **3.11 Reports & Configurations**

·         **Reports Available:**

o	Blocked Users Report

o	New Users Report

o	Leave Users Report

o	Last Login Report

o	Frozen Report

o	Employer Job Report

o	Locum Job Report

o	Private Locum Report

o	Locum Private Job Report

·         **Common Report Features:**

o	Table with: User ID, Name, Status, Relevant Data.

o	Filters: Date range, Status, Category.

o	Searchable fields.

o	Exportable in CSV/Excel.

 

## **4\. System Alerts & Notifications**

·         Expiry/Cancellation Alerts (subscription expiry, cancelled jobs).

·         Admin Email Notifications for disputes, freezes, high-value payments.

·         Push Notifications (optional) for urgent system issues.

## **5\. Emails received by admin**

 

On the email address, associated with the admin portal, emails should be received on the specific instances.

 

·  An employer posts a job

·  When someone freezes a job 

·  When a job booking happens

·  If employer or locum cancel

·  When a feedback is appealed

·  When someone deletes their profile

·  When someone new registers

·  When admin needs to approve the employer profile.

 

 

Place a button on a job page to mark job as completed ..

[image1]: <data:image/png;base64,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>