#!/usr/bin/python3
from sqlalchemy import create_engine
import pandas as pd

user = "root"
pw = ""
db = 'ipos'
irisData = pd.read_csv("AllMakes.csv")
engine = create_engine("mysql+pymysql://{user}:{pw}@localhost/{db}".format(user=user, pw=pw, db=db))
# Insert whole DataFrame into MySQL
irisData.to_sql('tbl_vehicle_model', con = engine, if_exists = 'append', chunksize = 1000,index=True)