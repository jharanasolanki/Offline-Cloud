#include<stdio.h>
#include<time.h>
void main()
{
int a[1000000],i,j,temp,pos;
int n=100000;
time_t seconds;
seconds=time(NULL);
printf("timestamp:%ld\n",seconds);
printf("enter elements\n");
for(i=0;i<n;i++)
	{
	a[i]=rand();
	}

for(i=0;i<n-1;i++)
	{
		pos=i;
		for(j=i+1;j<n;j++)
			{
			if(a[pos]>a[j])
			pos=j;
			}
		if(pos!=i)
		{
		temp=a[i];
		a[i]=a[pos];
		a[pos]=temp;
		}
	}
printf("sorted array:\n");
for(i=0;i<n;i++)
{
 //printf("%d\t",a[i]);
}
seconds=time(NULL);
printf("timestamp:%ld\n",seconds);
}

