import os
import django

os.environ.setdefault('DJANGO_SETTINGS_MODULE', 'uhv_project.settings')
django.setup()

from activities.models import Activity
from datetime import date

# Description for the Parents Workshop
description = """The Universal Human Values (UHV) Cell, PCCoE, Pune, successfully organized an online Parents Workshop, "A Bond That Lasts Beyond Academics," on 26th September 2026 for parents of First-Year B.Tech. students. The session received an encouraging response, with 83 participants joining from Pune, Dharashiv, Latur, Nagpur, Mumbai, Bhusaval, Jalgaon, Shirdi, and other locations.

Heartfelt gratitude to our respected PCET Trustees and Management for their continued vision and encouragement in supporting initiatives like "A Bond That Lasts Beyond Academics," which create meaningful opportunities to connect with parents and nurture the values, relationships, and well-being of our young adults.

The engaging sessions conducted by Dr. Sandeep Patil and Ms. Manjusha Devkule focused on strengthening parent-young adult relationships through trust, respect, affection, care, guidance, and mutual understanding, emphasizing the importance of parental involvement in student's holistic development.

The programme was successfully conducted under the guidance of Convener Dr. K. Rajeshwari.

We extend our sincere gratitude to Director Dr. Govind N. Kulkarni and Dr. K. Rajeshwari (Convener, UHV Cell and Dean Academics) for their valuable support, encouragement, and cooperation in making this programme a success.

We also express our heartfelt appreciation to Dr. Leena Sharma (HoD, AS&H) for her valuable guidance and insightful session for First-Year parents.

Special thanks to all the Institute Universal Human Values Cell members for their dedicated efforts, coordination, and contributions, and to all the participating parents for their enthusiastic involvement.

Together, let us nurture meaningful relationships, strengthen family bonds, and shape a brighter future for our students!

#UniversalHumanValues #UHVCell #PCCoE #PCET #ParentsWorkshop #ABondThatLastsBeyondAcademics #ParentYoungAdultRelationship #HolisticDevelopment #ValueBasedEducation #ParentEngagement #AICTE"""

TITLE = "A Bond That Lasts Beyond Academics: Strengthening Parent-Young Adult Relationships"

# Check if this activity already exists (avoid duplicates)
existing = Activity.objects.filter(title=TITLE).first()

if existing:
    print(f"Activity already exists with ID: {existing.pk}. Updating...")
    existing.description = description
    existing.student_count = 83
    existing.save()
    print(f"Updated: {existing.title}")
else:
    activity = Activity.objects.create(
        title=TITLE,
        date=date(2026, 9, 26),
        value_practiced="Relationships & Trust",
        student_count=83,
        description=description,
    )
    print(f"Created: {activity.title}")
    print(f"Date: {activity.date}")
    print(f"Value: {activity.value_practiced}")
    print(f"Participants: {activity.student_count}")
    print(f"ID: {activity.pk}")

print(f"\nTotal activities in database: {Activity.objects.count()}")
