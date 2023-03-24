<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/edit.css">
</head>
    <body>
        <nav>
            <h1>EMODERATION<span> WEB APP</span></h1>
         
            <ul> 
                <li><a href="./index.php">Upload</a></li>
                <li><a href="./moderate.php">Moderate</a></li>
                <li><a href="./report.php">Report</a></li>
                

                <li><a href="./changepassword.php">Change Password</a></li>
                
            </ul>
            <input type="submit"  onclick="location.href='../logout.php'" value="Logout">
        </nav>
      <div class="displays">
           <form action="form.php" method="POST">
                        
              <div class="heads">
                    <h1>HO TECHNICAL UNIVERSITY</h1>
                    <h2>FACULTY OF APPLIED SCIENCES AND TECHNOLOGY</h2>
                    <h3>DEPARTMENT OF COMPUTER SCIENCE</h3>
                    <h4>INTERNAL MODERATION OF HND EXAMINATION PAPERS</h4>
                    <h5>(Examination Questions and Marking Scheme Assetment Form)</h5>
              </div>
             <div class="fileds">
                <fieldset>
                    <legend>Section A: Preliminaries</legend>
                    <div class="ript">
                       <input type="text" id="field1" name="field1" value = "<?php echo "Computer Science" ?>" required readonly>
                    </div>
                    <div class="ript">
                        <input type="text" id="field2" placeholder="Accademic Year" name="acyear" required>
                    </div>
                    <div class="ript">
                        <select id="field2" name="sem" required>
                        <option value="">Select Semester</option>
                        <option value="1st">1st</option>
                        <option value="2nd">2nd</option>
                        </select>
                    </div>
                    <div class="ript">
                    <input type="text" id="field2" placeholder="Programme" name="programme" required>
                    </div>
                    <div class="ript">
                    <input type="text" id="field2" name="ccode" value ="<?php echo $code ?>"  required readonly>
                    </div>
                    <div class="ript">
                    <input type="text" id="field2" name="ctitle" value ="<?php echo $title ?>" required readonly>
                    </div>
                    <div class="ript">
                    <input type="text" id="field2" name="examiner" value = "<?php echo $lname; ?>" required readonly>
                    </div>
                </fieldset>
                <fieldset>
                    <legend>Section B : Prerequisties</legend>
                       <tbody>
                        <div class="ript">
                                <tr>
                                    <td>1</td>
                                    <td>Course Outline</td>
                                    <td>
                                        <input type="radio" id="yes1" name="row1" value="Yes">
                                        <label for="yes1">Yes</label>
                                        <input type="radio" id="no1" name="row1" value="No">
                                        <label for="no1">No</label>
                                    </td>
                                    
                                </tr>
                        </div>
                        <div class="ript">
                                <tr>
                                <td>2</td>
                                <td>Examination Question paper</td>
                                <td>
                                    <input type="radio" id="yes3" name="row2" value="Yes">
                                    <label for="yes3">Yes</label>
                                    <input type="radio" id="no3" name="row2" value="No">
                                    <label for="no3">No</label>
                                </td>
                            
                            </tr>
                        </div>
                        <div class="ript">
                        <tr>
						<td>3</td>
						<td>Marking scheme</td>
						<td>
							<input type="radio" id="yes3" name="row3" value="Yes">
							<label for="yes3">Yes</label>
							<input type="radio" id="no3" name="row3" value="No">
							<label for="no3">No</label>
						</td>
					
					</tr>
				
                        </div>
                        </tbody>
			          </table>
                </fieldset>
                <fieldset>
                    <legend>C:Verifications</legend>
                    <div class="ript1">
                    <ul>
                        <li>S/NO</li>
                        <li>RECQUIRED ITEM</li>
                        <li>SELECT</li>
                    </ul>
                </div>
               <div class="ript">
               <tr>
						<td>1</td>
						<td>Is the time allowed for the paper adequate?</td>
						<td>
							<input type="radio" id="yes1" name="row4" value="Yes">
							<label for="yes1">Yes</label>
							<input type="radio" id="no1" name="row4" value="No">
							<label for="no1">No</label>
						</td>
						
					</tr>
               </div>
               <div class="ript">
               <tr>
						<td>2</td>
						<td>Is the presentation and layout of the examination paper consistent with HTU approved rubrics/template?</td>
						<td>
							<input type="radio" id="yes3" name="row5" value="Yes">
							<label for="yes3">Yes</label>
							<input type="radio" id="no3" name="row5" value="No">
							<label for="no3">No</label>
						</td>
					
					</tr>

             </div>
             <div class="ript">
             <tr>
						<td>3</td>
						<td>Does the paper cover the course outline?</td>
						<td>
							<input type="radio" id="yes3" name="row6" value="Yes">
							<label for="yes3">Yes</label>
							<input type="radio" id="no3" name="row6" value="No">
							<label for="no3">No</label>
						</td>
					
					</tr>
             </div>
             <div class="ript">
             <tr>
						<td>4</td>
						<td>Are all questions worded in a clear and unambigous way?</td>
						<td>
							<input type="radio" id="yes3" name="row7" value="Yes">
							<label for="yes3">Yes</label>
							<input type="radio" id="no3" name="row7" value="No">
							<label for="no3">No</label>
						</td>
					
					</tr>
             </div>
             <div class="ript">
             <tr>
						<td>5</td>
						<td>Are the mark allocations for questions appropriate?</td>
						<td>
							<input type="radio" id="yes3" name="row8" value="Yes">
							<label for="yes3">Yes</label>
							<input type="radio" id="no3" name="row8" value="No">
							<label for="no3">No</label>
						</td>
					
					</tr>
            </div>
            <div class="ript">
                  
					<tr>
						<td>6</td>
						<td>Are there spelling or grammatical errors in any of the questions?</td>
						<td>
							<input type="radio" id="yes3" name="row9" value="Yes">
							<label for="yes3">Yes</label>
							<input type="radio" id="no3" name="row9" value="No">
							<label for="no3">No</label>
						</td>
					
					</tr>

           </div>
           <div class="ript">
           <tr>
						<td>7</td>
						<td>Is the standard of the questions appropriate for the level of the students?</td>
						<td>
							<input type="radio" id="yes3" name="row10" value="Yes">
							<label for="yes3">Yes</label>
							<input type="radio" id="no3" name="row10" value="No">
							<label for="no3">No</label>
						</td>
					
					</tr>
         </div>
         <div class="ript">
         <tr>
						<td>8</td>
						<td>Is there any question which requires further clarification?</td>
						<td>
							<input type="radio" id="yes3" name="row11" value="Yes">
							<label for="yes3">Yes</label>
							<input type="radio" id="no3" name="row11" value="No">
							<label for="no3">No</label>
						</td>
					
					</tr>

            </div>
            <div class="ript">
            <tr>
						<td>9</td>
						<td>Is the marking scheme relevant to the questions?</td>
						<td>
							<input type="radio" id="yes3" name="row12" value="Yes">
							<label for="yes3">Yes</label>
							<input type="radio" id="no3" name="row12" value="No">
							<label for="no3">No</label>
						</td>
					
					</tr>

            </div>
            <div class="ript">
            <tr>
						<td>10</td>
						<td>Does the marking scheme provide sufficient information and answers to the questions?</td>
						<td>
							<input type="radio" id="yes3" name="row13" value="Yes">
							<label for="yes3">Yes</label>
							<input type="radio" id="no3" name="row13" value="No">
							<label for="no3">No</label>
						</td>
					
					</tr>

            </div>
            <div class="ript">
            <tr>
						<td>11</td>
						<td>Are the answers in the marking scheme structured with breakdown of marks?</td>
						<td>
							<input type="radio" id="yes3" name="row14" value="Yes">
							<label for="yes3">Yes</label>
							<input type="radio" id="no3" name="row14" value="No">
							<label for="no3">No</label>
						</td>
					
					</tr>
				</tbody>
			</table>
            </div>
                </fieldset>
                <fieldset>
                   <legend>Section D : Decision of Assesor</legend>
                   <div class="ript1">
                        <ul>
                            <li>S/N</li>
                            <li>ASSESMENT QUESTION</li>
                            <li>SELECT</li>
                        </ul>
                    </div>
                  <div class="ript">
                  <tr>
						<td>1</td>
						<td>Is there any question that you would reject?</td>
						<td>
							<input type="radio" id="yes1" name="row15" value="Yes">
							<label for="yes1">Yes</label>
							<input type="radio" id="no1" name="row15" value="No">
							<label for="no1">No</label>
						</td>
						
					</tr>
                     
                  </div>
                  <div class="ript">
                  <tr>
						<td>2</td>
						<td>Is there something you want done before the paper would be acceptable?</td>
						<td>
							<input type="radio" id="yes3" name="row16" value="Yes">
							<label for="yes3">Yes</label>
							<input type="radio" id="no3" name="row16" value="No">
							<label for="no3">No</label>
						</td>
					
					</tr>
                  </div>
                  <div class="ript">
                  <tr>
						<td>3</td>
						<td>Would you pass the examination paper for external moderation?</td>
						<td>
							<input type="radio" id="yes3" name="row17" value="Yes">
							<label for="yes3">Yes</label>
							<input type="radio" id="no3" name="row17" value="No">
							<label for="no3">No</label>
						</td>
					
					</tr>
                  </div>
                 </fieldset>
                 <fieldset>
                  <legend>Section E : Recommendations/Observations</legend>
                       <div class="ript">
                       <textarea id="general-observation" name="general_observation" placeholder="General Obseravtion"></textarea>
                       </div>
                      <div class="ript">
                      <input type="text" id="head-of-department"  placeholder="Name Of H.O.D" name="head_of_department">
                      </div>
                      <div class="ript">
                      <input type="date" id="date" name="date" value="<?php echo date('Y-m-d'); ?>" required readonly>
                        </div>
                        <br>
                        <input type="hidden" name = "file" value="<?php echo $fp ?>">
                        <div class="saves">
                        <input type="submit" value="Approve" name="Approve"> 
                        </div>  
                        <div class="saves">
                        <input type="submit" value="Dissaprove" name="Dissaprove">
                        </div>                     
               </fieldset>
        </div>
</body>
</html>