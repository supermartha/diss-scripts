########################################################
#                                                               
# NAME: splice_stimuli.praat                            
#                                                               
# INPUT: - folder of .wav files with pairs of titles differing in one keyword
#              e.g  'northern' or 'southern', representing the two groups that we want 
#               to splice. Keywords should be at the end of the filename and preceded by
#				an underscore, e.g. 'pass_northern.wav' and 'pass_southern.wav'
#		 - directory: name of the folder with the .wav files
#		 - outputDirectory: name of folder to put formant measurements into (must already exist)
#		 - splicedDirectory: name of folder to put spliced stimuli into (must already exist)
#		 - guiseA: name of first guise (don't include underscore)
#		 - guiseB: name of second guise (don't inclue underscore) 
# 
# You also need to have a folder called 'text_grids/' in the same directory as this script
# in order for it to work. (Make sure you don't have anything you don't want overwritten in
# a folder with this name!)                                      
#                                                               
# DESCRIPTION:                                                        
#                                                               
# This script loops through all files in the target directory.  
# for each file it finds, it searches for the corresponding file from the other guise. 
# The user is prompted to select the segment to be spliced in each file.
# The script will then automatically find the points where the signal is at zero (zero crossing),
# and paste the second selection in place of the first, and vice versa, and save these
# in the splicedDirectory with the suffix '_spliced'. Also scales intensity of segment to be
# spliced in to have same intensity as original segment, as same pitch track. 
# To make a truly matched guise experiment, it's recommended that you pair a spliced version
# with the original recording (e.g. the original pass_northern.wav with pass_southern_spliced.wav)
# and counterbalance with the opposite pair (the original pass_southern.wav recording with 
# pass_northern_spliced.wav).    
# Also outputs formant measurements? Perhaps not very trustworthy.   
# Saves where you marked the vowel/segment for each audio file as a text grid in the 'text_grids/' folder. 
# Uses this text grid folder to keep track of what you've already done--
# if you want to re-do a stimulus you'll need to delete the text grids for that stimulus
# (or use a different script)          
#                                                                                         
# AUTHORSHIP:   
# Skeleton for this code based on 'splice&resplice.psc' script by 
# Daniel Lawrence, https://github.com/danielplawrence/  05/MAR/2013                                            
#      
# Modified by Martha Austen, 30 July 2016 & 3 May 2018                                                                               
########################################################


@initialRun

##############
procedure initialRun
form Splice a segment across pairs of words
	sentence directory sentences/
	sentence outputdirectory data/
	sentence splicedDirectory spliced/
	word guiseA trap
	word guiseB bath
endform

### Get list of text grids, to make sure you aren't redoing what you've already done
Create Strings as file list... textGrids text_grids/
n = Get number of strings

### Initialize file for storing formant values if empty
formantFile$ = outputdirectory$ + "formants.csv"
header$ = "stimulus" + tab$ + "guise" + tab$ + "f1" + tab$ + "f2" + tab$ + "f3"
if n == 0
	writeFileLine: formantFile$, header$
endif


# Recursion over files
Create Strings as file list... listfile 'directory$'*.wav
end = Get number of strings
for filecounter from 1 to end
	select Strings listfile
	file$ = Get string... filecounter
	Read from file... 'directory$''file$'
	Convert to mono
	newName$ = replace$(file$,".wav","", 1)
	Rename: newName$
	# Get an index
	sound$ = selected$ ("Sound")
	To TextGrid... vowel

	# Get guiseType (e.g. "trap" or "bath")
	guiseIndex = rindex(file$, "_")
	guiseType$ = right$(file$, length(file$) - guiseIndex)
	guiseType$ = replace$(guiseType$, ".wav", "", 1)
	filePrefix$ = left$(file$, guiseIndex)

	if guiseType$ == guiseA$
		otherGuise$ = guiseB$
		targetfile$ = filePrefix$ + otherGuise$ + ".wav"
		Read from file... 'directory$''targetfile$'
		Convert to mono
		Rename: filePrefix$ + otherGuise$

		### Check to see if text grid already exists, if it does
		### then don't do it again
		alreadyDone = 0
		textGridName$ = sound$ + ".TextGrid"
		select Strings textGrids
		n = Get number of strings
		for i from 1 to n
			name$ = Get string... i
			if textGridName$ == name$
				alreadyDone = 1
			endif
		endfor

		if alreadyDone == 0
			### Select appropriate intervals from both guises, measure formants.
			### The selectInterval procedure also splits files up into three parts
			### for splicing.
			currentGuise$ = "e"
			@selectInterval
			currentGuise$ = "i"
			sound$ = filePrefix$ + otherGuise$
			@selectInterval

			### Then splice them together
			@matchDuration
			@concatenateSounds

			### Clean up
			select Sound vowel_e
			plus Sound vowel_i
			plus Sound 'sound$'
			Remove
		endif
	else
		# Don't do anything
		otherGuise$ = "e"
	endif
endfor
endproc

############
# PROCEDURES (by me)
############

procedure selectInterval
######
# Pass this procedure a sound 'sound$'
# The script asks you to highlight the vowel,
# then saves your markings as a text grid and
# measures the formants at the midpoint.
######
	### Select relevant interval
	select Sound 'sound$'
	View & Edit
	editor Sound 'sound$'
		pause Locate target vowel
		Move start of selection to nearest zero crossing
		Move end of selection to nearest zero crossing
		vowelStart = Get start of selection
		vowelEnd = Get end of selection
	endeditor

	### Mark selection on a text grid and save it
	To TextGrid... vowels
	select TextGrid 'sound$'
	View & Edit
	editor TextGrid 'sound$'
		Move cursor to: vowelStart
		Add interval on tier 1
		Move cursor to: vowelEnd
		Add interval on tier 1
	endeditor
	# Save to text grid for future reference
	select TextGrid 'sound$'
	Write to text file... text_grids/'sound$'.TextGrid

	### Next: measure formants and write to file
	select Sound 'sound$'
	To Formant (burg)... 0.01 5 5000 0.025 50
	midpoint = vowelStart + (vowelEnd - vowelStart)/2
	select Formant 'sound$'
	f1 = Get value at time... 1 'midpoint' Hertz Linear
	f2 = Get value at time... 2 'midpoint' Hertz Linear
	f3 = Get value at time... 3 'midpoint' Hertz Linear
	formants$ = filePrefix$ + tab$ + currentGuise$ + tab$ + string$(f1) + tab$ + string$(f2) + tab$ + string$(f3)
	appendFileLine: formantFile$, formants$

	### Split sentence in half for splicing
	@splitSentence

	### Clean up
	select TextGrid 'sound$'
	plus Formant 'sound$'
	Remove
endproc


procedure splitSentence
	select Sound 'sound$'
	length = Get total duration
	Extract part... 0 vowelStart rectangular 1 no
	Rename: "firsthalf_" + currentGuise$
	select Sound 'sound$'
	Extract part... vowelStart vowelEnd rectangular 1 no
	Rename: "vowel_" + currentGuise$
	select Sound 'sound$'
	Extract part... vowelEnd length rectangular 1 no
	Rename: "secondhalf_" + currentGuise$
endproc

procedure matchDuration
	### Match duration of each vowel to the duration of the original vowel in the sentence
	### (so "e" gets the length of "i" and vice versa)
	### Also intensity and pitch
	select Sound vowel_e
	#e_dur = Get total duration
	e_intensity = Get intensity (dB)
	#appendInfoLine: e_dur
	select Sound vowel_i
	#i_dur = Get total duration
	i_intensity = Get intensity (dB)

	### Match intensity & pitch to original vowel
	select Sound vowel_e
	Scale intensity: i_intensity
	#Rename: "vowel_e"
	To Manipulation: 0.01, 145, 600
	Extract pitch tier

	select Sound vowel_i
	Scale intensity: e_intensity
	#Rename: "vowel_i"
	To Manipulation: 0.01, 145, 600
	Extract pitch tier

	select Manipulation vowel_e
	plus PitchTier vowel_i
	Replace pitch tier

	select Manipulation vowel_i
	plus PitchTier vowel_e
	Replace pitch tier
endproc


procedure concatenateSounds
	# Have to make a copy of the second half so that the sounds
	# are concatenated in the right order
	select Sound secondhalf_e
	Copy: "secondhalf_e_copy"
	select Sound firsthalf_e
	plus Sound vowel_i
	plus Sound secondhalf_e_copy
	Concatenate recoverably
	select Sound chain
	Rename: filePrefix$ + "i_spliced"
	Play
	pause OK?
	Write to WAV file... 'splicedDirectory$''filePrefix$''guiseB$'_spliced.wav

	### Repeat to splice "e" into the original "i" guise
	select Sound firsthalf_i
	Copy: "firsthalf_i_copy"
	select Sound vowel_e
	Copy: "vowel_e_copy"
	select Sound secondhalf_i
	Copy: "secondhalf_i_copy"
	select Sound firsthalf_i_copy
	plus Sound vowel_e_copy
	plus Sound secondhalf_i_copy
	Concatenate recoverably
	select Sound chain
	Rename: filePrefix$ + "e_spliced"
	Play
	pause OK?
	Write to WAV file... 'splicedDirectory$''filePrefix$''guiseA$'_spliced.wav
endproc

