function onSkillChanged(skill) {
    document.getElementById('skill').innerHTML = skill;
}

function onSkillLevelChanged(level) {
    document.getElementById('skill_level').innerHTML = 'Level ' + level;
}

function onWorkingHoursChanged(hours) {
    document.getElementById('working_hours').innerHTML = hours + 'h/day';
}
